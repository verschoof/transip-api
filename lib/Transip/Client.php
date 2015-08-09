<?php

namespace Transip;

use Transip\Exception\InvalidArgumentException;

/**
 * Class Client
 *
 * @package Transip
 */
class Client
{
    /**
     * The mode in which the API operates, can be either:
     *      readonly
     *      readwrite
     *
     * In readonly mode, no modifying functions can be called.
     * To make persistent changes, readwrite mode should be enabled.
     */
    protected $mode = 'readwrite';

    /**
     * Available modes for the API
     */
    static public $availableModes = array(
        'readonly',
        'readwrite'
    );

    /**
     * TransIP API endpoint to connect to.
     *
     * e.g.:
     *      'api.transip.nl'
     *      'api.transip.be'
     *      'api.transip.eu'
     */
    protected $endpoint = 'api.transip.nl';

    /**
     * Your login name on the TransIP website.
     */
    protected $login;

    /**
     * One of your private keys; these can be requested via your Controlpanel
     */
    protected $privateKey;

    /**
     * @param string $login
     * @param string $privateKey
     * @param bool   $debug
     * @param string $endpoint
     */
    public function __construct($login, $privateKey, $debug = false, $endpoint = 'api.transip.nl')
    {
        $this->login      = $login;
        $this->privateKey = $privateKey;
        $this->endpoint   = $endpoint;

        if ($debug) {
            $this->mode = 'readonly';
        }
    }

    /**
     * @param string $name
     *
     * @return Api\Colocation|Api\Domain|Api\Forward|Api\Webhosting
     * @throws Exception\InvalidArgumentException
     */
    public function api($name)
    {
        switch ($name) {
            case 'domain':
                $api = new Api\Domain($this);
                break;
            case 'webhosting':
                $api = new Api\Webhosting($this);
                break;
            case 'forward':
                $api = new Api\Forward($this);
                break;
            case 'colocation':
                $api = new Api\Colocation($this);
                break;
	        case 'vps':
		        $api = new Api\Vps($this);
		        break;

            default:
                throw new InvalidArgumentException(sprintf('Undefined api instance called: "%s"', $name));
        }

        return $api;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getPrivateKey()
    {
        return $this->privateKey;
    }

    /**
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @param string $mode
     *
     * @throws \Exception
     */
    public function setMode($mode)
    {
        if (in_array($mode, $this->availableModes)) {
            $this->mode = $mode;
        }

        throw new \Exception("$mode is not a available mode for this API.");
    }
}
