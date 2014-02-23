<?php

namespace Transip\Api;

use Transip\Client as Client;

/**
 * This is the base of all the Services
 *
 * @package Transip
 * @class SoapClientAbstract
 * @author TransIP (support@transip.nl)
 * @author Mitchel Verschoof (mitchel@verschoof.net)
 * @version 20131025 10:01
 */
abstract class SoapClientAbstract
{
    /** The API version. */
    protected $apiVersion = '4.2';

    /** @var SoapClient  The SoapClient used to perform the SOAP calls. */
    protected $soapClient = null;

    /** The client class */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    /**
     * Gets the singleton SoapClient which is used to connect to the TransIP Api.
     *
     * @param  mixed       $parameters  Parameters.
     * @return SoapClient               The SoapClient object to which we can connect to the TransIP API
     */
    protected function soapClient(array $classMap, $parameters = array())
    {
        $endpoint = $this->client->getEndPoint();

        if ($this->soapClient === null) {
            $extensions = get_loaded_extensions();
            $errors     = array();

            if(!class_exists('SoapClient') || !in_array('soap', $extensions)) {
                $errors[] = 'The PHP SOAP extension doesn\'t seem to be installed. You need to install the PHP SOAP extension. (See: http://www.php.net/manual/en/book.soap.php)';
            }
            if(!in_array('openssl', $extensions)) {
                $errors[] = 'The PHP OpenSSL extension doesn\'t seem to be installed. You need to install PHP with the OpenSSL extension. (See: http://www.php.net/manual/en/book.openssl.php)';
            }
            if (!empty($errors)) {
                die('<p>' . implode("</p>\n<p>", $errors) . '</p>');
            }

            $classMap = array(
                'DomainCheckResult' => 'Transip_DomainCheckResult',
                'Domain'            => 'Transip_Domain',
                'Nameserver'        => 'Transip_Nameserver',
                'WhoisContact'      => 'Transip_WhoisContact',
                'DnsEntry'          => 'Transip_DnsEntry',
                'DomainBranding'    => 'Transip_DomainBranding',
                'Tld'               => 'Transip_Tld',
                'DomainAction'      => 'Transip_DomainAction',
            );

            $options = array(
                'classmap' => $classMap,
                'encoding' => 'utf-8', // lets support unicode
                'features' => SOAP_SINGLE_ELEMENT_ARRAYS, // see http://bugs.php.net/bug.php?id=43338
                'trace'    => false, // can be used for debugging
            );

            $wsdlUri  = "https://{$endpoint}/wsdl/?service=" . $this->service;
            try {
                $this->soapClient = new \SoapClient($wsdlUri, $options);
            } catch(SoapFault $sf) {
                throw new \Exception("Unable to connect to endpoint '{$endpoint}'");
            }

            $this->soapClient->__setCookie('login', $this->client->getLogin());
            $this->soapClient->__setCookie('mode', $this->client->getMode());
        }

        $timestamp = time();
        $nonce     = uniqid('', true);

        $this->soapClient->__setCookie('timestamp', $timestamp);
        $this->soapClient->__setCookie('nonce', $nonce);
        $this->soapClient->__setCookie('clientVersion', $this->apiVersion);
        $this->soapClient->__setCookie('signature', $this->_urlencode($this->_sign(array_merge($parameters, array(
            '__service'   => $this->service,
            '__hostname'  => $endpoint,
            '__timestamp' => $timestamp,
            '__nonce'     => $nonce
        )))));

        return $this->soapClient;
    }

    /**
     * Calculates the hash to sign our request with based on the given parameters.
     *
     * @param  mixed   $parameters  The parameters to sign.
     * @return string               Base64 encoded signing hash.
     */
    protected function _sign($parameters)
    {
        // Fixup our private key, copy-pasting the key might lead to whitespace faults
        if (!preg_match('/-----BEGIN (RSA )?PRIVATE KEY-----(.*)-----END (RSA )?PRIVATE KEY-----/si', $this->client->getPrivateKey(), $matches)) {
            die('<p>Could not find your private key, please supply your private key in the ApiSettings file. You can request a new private key in your TransIP Controlpanel.</p>');
        }

        $key = $matches[2];
        $key = preg_replace('/\s*/s', '', $key);
        $key = chunk_split($key, 64, "\n");

        $key = "-----BEGIN PRIVATE KEY-----\n" . $key . "-----END PRIVATE KEY-----";

        $digest = $this->_sha512Asn1($this->_encodeParameters($parameters));
        if (!@openssl_private_encrypt($digest, $signature, $key)) {
            die('<p>Could not sign your request, please supply your private key in the ApiSettings file. You can request a new private key in your TransIP Controlpanel.</p>');
        }

        return base64_encode($signature);
    }

    /**
     * Creates a digest of the given data, with an asn1 header.
     *
     * @param  string  $data  The data to create a digest of.
     * @return string         The digest of the data, with asn1 header.
     */
    protected function _sha512Asn1($data)
    {
        $digest = hash('sha512', $data, true);

        // this ASN1 header is sha512 specific
        $asn1  = chr(0x30).chr(0x51);
        $asn1 .= chr(0x30).chr(0x0d);
        $asn1 .= chr(0x06).chr(0x09);
        $asn1 .= chr(0x60).chr(0x86).chr(0x48).chr(0x01).chr(0x65);
        $asn1 .= chr(0x03).chr(0x04);
        $asn1 .= chr(0x02).chr(0x03);
        $asn1 .= chr(0x05).chr(0x00);
        $asn1 .= chr(0x04).chr(0x40);
        $asn1 .= $digest;

        return $asn1;
    }

    /**
     * Encodes the given paramaters into a url encoded string based upon RFC 3986.
     *
     * @param  mixed   $parameters  The parameters to encode.
     * @param  string  $keyPrefix   Key prefix.
     * @return string               The given parameters encoded according to RFC 3986.
     */
    protected function _encodeParameters($parameters, $keyPrefix = null)
    {
        if(!is_array($parameters) && !is_object($parameters))
            return $this->_urlencode($parameters);

        $encodedData = array();

        foreach($parameters as $key => $value) {
            $encodedKey = is_null($keyPrefix)
                ? $this->_urlencode($key)
                : $keyPrefix . '[' . $this->_urlencode($key) . ']';

            if (is_array($value) || is_object($value)) {
                $encodedData[] = $this->_encodeParameters($value, $encodedKey);
            } else {
                $encodedData[] = $encodedKey . '=' . $this->_urlencode($value);
            }
        }

        return implode('&', $encodedData);
    }

    /**
     * Our own function to encode a string according to RFC 3986 since.
     * PHP < 5.3.0 encodes the ~ character which is not allowed.
     *
     * @param string $string The string to encode.
     * @return string The encoded string according to RFC 3986.
     */
    protected function _urlencode($string)
    {
        $string = rawurlencode($string);
        return str_replace('%7E', '~', $string);
    }
}