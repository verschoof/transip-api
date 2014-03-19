<?php

namespace Transip\Api;

/**
 * This is the API endpoint for the DomainService
 *
 * @package Transip
 * @class   DomainService
 * @author  TransIP (support@transip.nl)
 * @author  Mitchel Verschoof (mitchel@verschoof.net)
 * @version 20131025 10:01
 */
class Domain extends SoapClientAbstract
{
    const AVAILABILITY_INYOURACCOUNT   = 'inyouraccount';
    const AVAILABILITY_UNAVAILABLE     = 'unavailable';
    const AVAILABILITY_NOTFREE         = 'notfree';
    const AVAILABILITY_FREE            = 'free';
    const AVAILABILITY_INTERNALPULL    = 'internalpull';
    const CANCELLATIONTIME_END         = 'end';
    const CANCELLATIONTIME_IMMEDIATELY = 'immediately';
    const ACTION_REGISTER              = 'register';
    const ACTION_TRANSFER              = 'transfer';
    const ACTION_INTERNALPULL          = 'internalpull';

    /** The SOAP service that corresponds with this class. */
    protected $service = 'DomainService';


    /**
     * Gets the singleton SoapClient which is used to connect to the TransIP Api.
     *
     * @param  mixed $parameters Parameters.
     * @return \SoapClient               The SoapClient object to which we can connect to the TransIP API
     */
    protected function getSoapClient($parameters = array())
    {
        $classMap = array(
            'DomainCheckResult' => 'Transip\\Model\\DomainCheckResult',
            'Domain'            => 'Transip\\Model\\Domain',
            'Nameserver'        => 'Transip\\Model\\Nameserver',
            'WhoisContact'      => 'Transip\\Model\\WhoisContact',
            'DnsEntry'          => 'Transip\\Model\\DnsEntry',
            'DomainBranding'    => 'Transip\\Model\\DomainBranding',
            'Tld'               => 'Transip\\Model\\Tld',
            'DomainAction'      => 'Transip\\Model\\DomainAction',
        );

        return $this->soapClient($classMap, $parameters);
    }

    /**
     * Checks the availability of multiple domains.
     *
     * @param string[] $domainNames The domain names to check for availability. A maximum of 20 domainNames at once
     * @throws ApiException
     * @return \Transip\Model\DomainCheckResult[] A list of DomainCheckResult objects, holding the domainName and the status per result.
     */
    public function batchCheckAvailability($domainNames)
    {
        return $this->getSoapClient(array_merge(array($domainNames), array('__method' => 'batchCheckAvailability')))->batchCheckAvailability($domainNames);
    }

    /**
     * Checks the availability of a domain.
     *
     * @param string $domainName The domain name to check for availability.
     * @return string the availability status of the domain name:
     */
    public function checkAvailability($domainName)
    {
        return $this->getSoapClient(array_merge(array($domainName), array('__method' => 'checkAvailability')))->checkAvailability($domainName);
    }

    /**
     * Gets the whois of a domain name
     *
     * @param string $domainName the domain name to get the whois for
     * @return string the whois data for the domain
     */
    public function getWhois($domainName)
    {
        return $this->getSoapClient(array_merge(array($domainName), array('__method' => 'getWhois')))->getWhois($domainName);
    }

    /**
     * Gets the names of all domains in your account.
     *
     * @return string[] A list of all domains in your account
     */
    public function getDomainNames()
    {
        return $this->getSoapClient(array_merge(array(), array('__method' => 'getDomainNames')))->getDomainNames();
    }

    /**
     * Get information about a domainName.
     *
     * @param string $domainName The domainName to get the information for.
     * @throws ApiException  If the Domain could not be found.
     * @return \Transip\Model\Domain A Domain object holding the data for the requested domainName.
     */
    public function getInfo($domainName)
    {
        return $this->getSoapClient(array_merge(array($domainName), array('__method' => 'getInfo')))->getInfo($domainName);
    }

    /**
     * Get information about a list of Domain names.
     *
     * @param string[] $domainNames A list of Domain names you want information for.
     * @throws Exception     If something else went wrong.
     * @return \Transip\Model\Domain[] Domain objects.
     */
    public function batchGetInfo($domainNames)
    {
        return $this->getSoapClient(array_merge(array($domainNames), array('__method' => 'batchGetInfo')))->batchGetInfo($domainNames);
    }

    /**
     * Gets the Auth code for a domainName
     *
     * @param string $domainName the domainName to get the authcode for
     * @deprecated
     * @return string the authentication code for a domain name
     */
    public function getAuthCode($domainName)
    {
        return $this->getSoapClient(array_merge(array($domainName), array('__method' => 'getAuthCode')))->getAuthCode($domainName);
    }

    /**
     * Gets the lock status for a domainName
     *
     * @param string $domainName the domainName to get the lock status for
     * @return boolean true iff the domain is locked at the registry
     * @deprecated use getInfo()
     */
    public function getIsLocked($domainName)
    {
        return $this->getSoapClient(array_merge(array($domainName), array('__method' => 'getIsLocked')))->getIsLocked($domainName);
    }

    /**
     * Registers a domain name, will automatically create and sign a proposition for it
     *
     * @param \Transip\Model\Domain $domain The Domain object holding information about the domain that needs to be registered.
     * @requires readwrite mode
     * @throws ApiException
     */
    public function register(\Transip\Model\Domain $domain)
    {
        return $this->getSoapClient(array_merge(array($domain), array('__method' => 'register')))->register($domain);
    }

    /**
     * Cancels a domain name, will automatically create and sign a cancellation document
     * Please note that domains with webhosting cannot be cancelled through the API
     *
     * @param string $domainName The domainname that needs to be cancelled.
     * @param string $endTime    The time to cancel the domain (Domain::CANCELLATIONTIME_END (end of contract)
     * @requires readwrite mode
     * @throws ApiException
     */
    public function cancel($domainName, $endTime)
    {
        return $this->getSoapClient(array_merge(array($domainName, $endTime), array('__method' => 'cancel')))->cancel($domainName, $endTime);
    }

    /**
     * Transfers a domain with changing the owner, not all TLDs support this (e.g. nl)
     *
     * @param \Transip\Model\Domain $domain   the Domain object holding information about the domain that needs to be transfered
     * @param string                $authCode the authorization code for domains needing this for transfers (e.g. .com or .org transfers). Leave empty when n/a.
     * @requires readwrite mode
     */
    public function transferWithOwnerChange(\Transip\Model\Domain $domain, $authCode)
    {
        return $this->getSoapClient(array_merge(array($domain, $authCode), array('__method' => 'transferWithOwnerChange')))->transferWithOwnerChange($domain, $authCode);
    }

    /**
     * Transfers a domain without changing the owner
     *
     * @param \Transip\Model\Domain $domain   the Domain object holding information about the domain that needs to be transfered
     * @param string                $authCode the authorization code for domains needing this for transfers (e.g. .com or .org transfers). Leave empty when n/a.
     * @requires readwrite mode
     */
    public function transferWithoutOwnerChange(\Transip\Model\Domain $domain, $authCode)
    {
        return $this->getSoapClient(array_merge(array($domain, $authCode), array('__method' => 'transferWithoutOwnerChange')))->transferWithoutOwnerChange($domain, $authCode);
    }

    /**
     * Starts a nameserver change for this domain, will replace all existing nameservers with the new nameservers
     *
     * @param string                      $domainName  the domainName to change the nameservers for
     * @param \Transip\Model\Nameserver[] $nameservers the list of new nameservers for this domain
     * @throws \RuntimeException
     */
    public function setNameservers($domainName, $nameservers)
    {
        foreach ($nameservers as $nameserver) {
            if (!$nameserver instanceof \Transip\Model\Nameserver) {
                throw new \RuntimeException(sprintf('nameserver is not an instance of %s', '\\Transip\\Model\\Nameserver'));
            }
        }

        return $this->getSoapClient(array_merge(array($domainName, $nameservers), array('__method' => 'setNameservers')))->setNameservers($domainName, $nameservers);
    }

    /**
     * Lock this domain in real time
     *
     * @param string $domainName the domainName to set the lock for
     */
    public function setLock($domainName)
    {
        return $this->getSoapClient(array_merge(array($domainName), array('__method' => 'setLock')))->setLock($domainName);
    }

    /**
     * unlocks this domain in real time
     *
     * @param string $domainName the domainName to unlock
     */
    public function unsetLock($domainName)
    {
        return $this->getSoapClient(array_merge(array($domainName), array('__method' => 'unsetLock')))->unsetLock($domainName);
    }

    /**
     * Sets the DnEntries for this Domain, will replace all existing dns entries with the new entries
     *
     * @param string                    $domainName the domainName to change the dns entries for
     * @param \Transip\Model\DnsEntry[] $dnsEntries the list of new DnsEntries for this domain
     * @throws \RuntimeException
     */
    public function setDnsEntries($domainName, $dnsEntries)
    {
        foreach ($dnsEntries as $dnsEntry) {
            if (!$dnsEntry instanceof \Transip\Model\DnsEntry) {
                throw new \RuntimeException(sprintf('DnsEntry is not instance of %s', '\\Transip\\Model\\DnsEntry'));
            }
        }

        return $this->getSoapClient(array_merge(array($domainName, $dnsEntries), array('__method' => 'setDnsEntries')))->setDnsEntries($domainName, $dnsEntries);
    }

    /**
     * Starts an owner change of a Domain, brings additional costs with the following TLDs:
     * .nl
     * .be
     * .eu
     *
     * @param string                      $domainName             the domainName to change the owner for
     * @param \Transip\Model\WhoisContact $registrantWhoisContact the new contact data for this
     * @throws ApiException
     */
    public function setOwner($domainName, \Transip\Model\WhoisContact $registrantWhoisContact)
    {
        return $this->getSoapClient(array_merge(array($domainName, $registrantWhoisContact), array('__method' => 'setOwner')))->setOwner($domainName, $registrantWhoisContact);
    }

    /**
     * Starts a contact change of a domain, this will replace all existing contacts
     *
     * @param string                        $domainName the domainName to change the contacts for
     * @param \Transip\Model\WhoisContact[] $contacts   the list of new contacts for this domain
     * @throws \RuntimeException
     */
    public function setContacts($domainName, $contacts)
    {
        foreach ($contacts as $contact) {
            if (!$contact instanceof \Transip\Model\WhoisContact) {
                throw new \RuntimeException(sprintf('Contact is not an instance of %s', '\\Transip\\Model\\WhoisContact'));
            }
        }

        return $this->getSoapClient(array_merge(array($domainName, $contacts), array('__method' => 'setContacts')))->setContacts($domainName, $contacts);
    }

    /**
     * Get TransIP supported TLDs
     *
     * @return \Transip\Model\Tld[] Array of Tld objects
     */
    public function getAllTldInfos()
    {
        return $this->getSoapClient(array_merge(array(), array('__method' => 'getAllTldInfos')))->getAllTldInfos();
    }

    /**
     * Get info about a specific TLD
     *
     * @param string $tldName The tld to get information about.
     * @example examples/DomainService-DomainService-getAllTldInfos.php
     * @throws ApiException  If the TLD could not be found.
     * @return \Transip\Model\Tld Tld object with info about this Tld
     */
    public function getTldInfo($tldName)
    {
        return $this->getSoapClient(array_merge(array($tldName), array('__method' => 'getTldInfo')))->getTldInfo($tldName);
    }

    /**
     * Gets info about the action this domain is currently running
     *
     * @param string $domainName Name of the domain
     * @return \Transip\Model\DomainAction if this domain is currently running an action, a corresponding DomainAction with info about the action will be returned.
     * @example examples/DomainService-DomainService-domainActions.php
     */
    public function getCurrentDomainAction($domainName)
    {
        return $this->getSoapClient(array_merge(array($domainName), array('__method' => 'getCurrentDomainAction')))->getCurrentDomainAction($domainName);
    }

    /**
     * Retries a failed domain action with new domain data. The Domain#name field must contain
     * the name of the Domain, the nameserver, contacts, dnsEntries fields contain the new data for this domain.
     * Set a field to null to not change the data.
     *
     * @param \Transip\Model\Domain $domain The domain with data to retry
     * @example examples/DomainService-DomainService-domainActions.php
     * @throws ApiException
     */
    public function retryCurrentDomainActionWithNewData(\Transip\Model\Domain $domain)
    {
        return $this->getSoapClient(array_merge(array($domain), array('__method' => 'retryCurrentDomainActionWithNewData')))->retryCurrentDomainActionWithNewData($domain);
    }

    /**
     * Retry a transfer action with a new authcode
     *
     * @param \Transip\Model\Domain $domain      The domain to try the transfer with a different authcode for
     * @param string                $newAuthCode New authorization code to try
     */
    public function retryTransferWithDifferentAuthCode(\Transip\Model\Domain $domain, $newAuthCode)
    {
        return $this->getSoapClient(array_merge(array($domain, $newAuthCode), array('__method' => 'retryTransferWithDifferentAuthCode')))->retryTransferWithDifferentAuthCode($domain, $newAuthCode);
    }

    /**
     * Cancels a failed domain action
     *
     * @param \Transip\Model\Domain $domain the domain to cancel the action for
     * @example examples/DomainService-DomainService-domainActions.php
     * @throws ApiException
     */
    public function cancelDomainAction(\Transip\Model\Domain $domain)
    {
        return $this->getSoapClient(array_merge(array($domain), array('__method' => 'cancelDomainAction')))->cancelDomainAction($domain);
    }
}