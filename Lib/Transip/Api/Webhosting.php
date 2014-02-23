<?php

namespace Transip\Api;

/**
 * This is the API endpoint for the WebhostingService
 *
 * @package Transip
 * @class WebhostingService
 * @author TransIP (support@transip.nl)
 * @author Mitchel Verschoof (mitchel@verschoof.net)
 * @version 20131025 10:01
 */
class Webhosting extends SoapClientAbstract
{
	const CANCELLATIONTIME_END         = 'end';
	const CANCELLATIONTIME_IMMEDIATELY = 'immediately';

	/** The SOAP service that corresponds with this class. */
	protected $service = 'WebhostingService';


	/**
	 * Gets the singleton SoapClient which is used to connect to the TransIP Api.
	 *
	 * @param  mixed       $parameters  Parameters.
	 * @return SoapClient               The SoapClient object to which we can connect to the TransIP API
	 */
	public static function _getSoapClient($parameters = array())
	{
		$classMap = array(
			'WebhostingPackage' => 'Transip_WebhostingPackage',
			'WebHost'           => 'Transip_WebHost',
			'Cronjob'           => 'Transip_Cronjob',
			'MailBox'           => 'Transip_MailBox',
			'Db'                => 'Transip_Db',
			'MailForward'       => 'Transip_MailForward',
			'SubDomain'         => 'Transip_SubDomain',
		);

		return $this->soapClient($classMap, $parameters);
	}

	/**
	 * Get all domain names that have a webhosting package attached to them.
	 *
	 * @return string[] List of domain names that have a webhosting package
	 */
	public static function getWebhostingDomainNames()
	{
		return $this->_getSoapClient(array_merge(array(), array('__method' => 'getWebhostingDomainNames')))->getWebhostingDomainNames();
	}

	/**
	 * Get available webhosting packages
	 *
	 * @return Transip_WebhostingPackage[] List of available webhosting packages
	 */
	public static function getAvailablePackages()
	{
		return $this->_getSoapClient(array_merge(array(), array('__method' => 'getAvailablePackages')))->getAvailablePackages();
	}

	/**
	 * Get information about existing webhosting on a domain.
	 *
	 * Please be aware that the information returned is outdated when
	 * a modifying function in Transip_WebhostingService is called (e.g. createCronjob()).
	 *
	 * Call this function again to refresh the info.
	 *
	 * @param string $domainName The domain name of the webhosting package to get the info for. Must be owned by this user
	 * @return Transip_WebHost WebHost object with all info about the requested webhosting package
	 */
	public static function getInfo($domainName)
	{
		return $this->_getSoapClient(array_merge(array($domainName), array('__method' => 'getInfo')))->getInfo($domainName);
	}

	/**
	 * Order webhosting for a domain name
	 *
	 * @param string $domainName The domain name to order the webhosting for. Must be owned by this user
	 * @param Transip_WebhostingPackage $webhostingPackage The webhosting Package to order, one of the packages returned by Transip_WebhostingService::getAvailablePackages()
	 * @throws ApiException on error
	 */
	public static function order($domainName, $webhostingPackage)
	{
		return $this->_getSoapClient(array_merge(array($domainName, $webhostingPackage), array('__method' => 'order')))->order($domainName, $webhostingPackage);
	}

	/**
	 * Get available upgrades packages for a domain name with webhosting. Only those packages will be returned to which
	 * the given domain name can be upgraded to.
	 *
	 * @param string $domainName Domain to get upgrades for. Must be owned by the current user.
	 * @return Transip_WebhostingPackage[] Available packages to which the domain name can be upgraded to.
	 */
	public static function getAvailableUpgrades($domainName)
	{
		return $this->_getSoapClient(array_merge(array($domainName), array('__method' => 'getAvailableUpgrades')))->getAvailableUpgrades($domainName);
	}

	/**
	 * Upgrade the webhosting of a domain name to a new webhosting package to a given new package.
	 *
	 * @param string $domainName The domain to upgrade webhosting for. Must be owned by the current user.
	 * @param string $newWebhostingPackage The new webhosting package, must be one of the packages returned getAvailableUpgrades() for the given domain name
	 */
	public static function upgrade($domainName, $newWebhostingPackage)
	{
		return $this->_getSoapClient(array_merge(array($domainName, $newWebhostingPackage), array('__method' => 'upgrade')))->upgrade($domainName, $newWebhostingPackage);
	}

	/**
	 * Cancel webhosting for a domain
	 *
	 * @param string $domainName The domain to cancel the webhosting for
	 * @param string $endTime the time to cancel the domain (WebhostingService::CANCELLATIONTIME_END (end of contract) or WebhostingService::CANCELLATIONTIME_IMMEDIATELY (as soon as possible))
	 */
	public static function cancel($domainName, $endTime)
	{
		return $this->_getSoapClient(array_merge(array($domainName, $endTime), array('__method' => 'cancel')))->cancel($domainName, $endTime);
	}

	/**
	 * Set a new FTP password for a webhosting package
	 *
	 * @param string $domainName Domain to set webhosting FTP password for
	 * @param string $newPassword The new FTP password for the webhosting package
	 */
	public static function setFtpPassword($domainName, $newPassword)
	{
		return $this->_getSoapClient(array_merge(array($domainName, $newPassword), array('__method' => 'setFtpPassword')))->setFtpPassword($domainName, $newPassword);
	}

	/**
	 * Create a cronjob
	 *
	 * @param string $domainName the domain name of the webhosting package to create cronjob for
	 * @param Transip_Cronjob $cronjob the cronjob to create. All fields must be valid.
	 */
	public static function createCronjob($domainName, $cronjob)
	{
		return $this->_getSoapClient(array_merge(array($domainName, $cronjob), array('__method' => 'createCronjob')))->createCronjob($domainName, $cronjob);
	}

	/**
	 * Delete a cronjob from a webhosting package.
	 * Note, all completely matching cronjobs will be removed
	 *
	 * @param string $domainName the domain name of the webhosting package to delete a cronjob
	 * @param Transip_Cronjob $cronjob Cronjob the cronjob to delete. Be aware that all matching cronjobs will be removed.
	 */
	public static function deleteCronjob($domainName, $cronjob)
	{
		return $this->_getSoapClient(array_merge(array($domainName, $cronjob), array('__method' => 'deleteCronjob')))->deleteCronjob($domainName, $cronjob);
	}

	/**
	 * Creates a MailBox for a webhosting package.
	 * The address field of the MailBox object must be unique.
	 *
	 * @param string $domainName the domain name of the webhosting package to create the mailbox for
	 * @param Transip_MailBox $mailBox MailBox object to create
	 */
	public static function createMailBox($domainName, $mailBox)
	{
		return $this->_getSoapClient(array_merge(array($domainName, $mailBox), array('__method' => 'createMailBox')))->createMailBox($domainName, $mailBox);
	}

	/**
	 * Modifies MailBox settings
	 *
	 * @param string $domainName the domain name of the webhosting package to modify the mailbox for
	 * @param Transip_MailBox $mailBox the MailBox to modify
	 */
	public static function modifyMailBox($domainName, $mailBox)
	{
		return $this->_getSoapClient(array_merge(array($domainName, $mailBox), array('__method' => 'modifyMailBox')))->modifyMailBox($domainName, $mailBox);
	}

	/**
	 * Sets a new password for a MailBox
	 *
	 * @param string $domainName the domain name of the webhosting package to set the mailbox password for
	 * @param Transip_MailBox $mailBox the MailBox to set the password for
	 * @param string $newPassword the new password for the MailBox, cannot be empty.
	 */
	public static function setMailBoxPassword($domainName, $mailBox, $newPassword)
	{
		return $this->_getSoapClient(array_merge(array($domainName, $mailBox, $newPassword), array('__method' => 'setMailBoxPassword')))->setMailBoxPassword($domainName, $mailBox, $newPassword);
	}

	/**
	 * Deletes a MailBox from a webhosting package
	 *
	 * @param string $domainName the domain name of the webhosting package to remove the MailBox from
	 * @param Transip_MailBox $mailBox the mailbox object to remove
	 */
	public static function deleteMailBox($domainName, $mailBox)
	{
		return $this->_getSoapClient(array_merge(array($domainName, $mailBox), array('__method' => 'deleteMailBox')))->deleteMailBox($domainName, $mailBox);
	}

	/**
	 * Creates a MailForward for a webhosting package
	 *
	 * @param string $domainName the domain name of the webhosting package to add the MailForward to
	 * @param Transip_MailForward $mailForward The MailForward object to create
	 */
	public static function createMailForward($domainName, $mailForward)
	{
		return $this->_getSoapClient(array_merge(array($domainName, $mailForward), array('__method' => 'createMailForward')))->createMailForward($domainName, $mailForward);
	}

	/**
	 * Changes an active MailForward object
	 *
	 * @param string $domainName the domain name of the webhosting package to modify the MailForward from
	 * @param Transip_MailForward $mailForward the MailForward to modify
	 */
	public static function modifyMailForward($domainName, $mailForward)
	{
		return $this->_getSoapClient(array_merge(array($domainName, $mailForward), array('__method' => 'modifyMailForward')))->modifyMailForward($domainName, $mailForward);
	}

	/**
	 * Deletes an active MailForward object
	 *
	 * @param string $domainName the domain name of the webhosting package to delete the MailForward from
	 * @param Transip_MailForward $mailForward the MailForward to delete
	 */
	public static function deleteMailForward($domainName, $mailForward)
	{
		return $this->_getSoapClient(array_merge(array($domainName, $mailForward), array('__method' => 'deleteMailForward')))->deleteMailForward($domainName, $mailForward);
	}

	/**
	 * Creates a new database
	 *
	 * @param string $domainName the domain name of the webhosting package to create the Db for
	 * @param Transip_Db $db Db object to create
	 */
	public static function createDatabase($domainName, $db)
	{
		return $this->_getSoapClient(array_merge(array($domainName, $db), array('__method' => 'createDatabase')))->createDatabase($domainName, $db);
	}

	/**
	 * Changes a Db object
	 *
	 * @param string $domainName the domain name of the webhosting package to change the Db for
	 * @param Transip_Db $db The db object to modify
	 */
	public static function modifyDatabase($domainName, $db)
	{
		return $this->_getSoapClient(array_merge(array($domainName, $db), array('__method' => 'modifyDatabase')))->modifyDatabase($domainName, $db);
	}

	/**
	 * Sets A database password for a Db
	 *
	 * @param string $domainName the domain name of the webhosting package of the Db to change the password for
	 * @param Transip_Db $db Modified database object to save
	 * @param string $newPassword New password for the database
	 */
	public static function setDatabasePassword($domainName, $db, $newPassword)
	{
		return $this->_getSoapClient(array_merge(array($domainName, $db, $newPassword), array('__method' => 'setDatabasePassword')))->setDatabasePassword($domainName, $db, $newPassword);
	}

	/**
	 * Deletes a Db object
	 *
	 * @param string $domainName the domain name of the webhosting package to delete the Db for
	 * @param Transip_Db $db Db object to remove
	 */
	public static function deleteDatabase($domainName, $db)
	{
		return $this->_getSoapClient(array_merge(array($domainName, $db), array('__method' => 'deleteDatabase')))->deleteDatabase($domainName, $db);
	}

	/**
	 * Creates a SubDomain
	 *
	 * @param string $domainName the domain name of the webhosting package to create the SubDomain for
	 * @param Transip_SubDomain $subDomain SubDomain object to create
	 */
	public static function createSubdomain($domainName, $subDomain)
	{
		return $this->_getSoapClient(array_merge(array($domainName, $subDomain), array('__method' => 'createSubdomain')))->createSubdomain($domainName, $subDomain);
	}

	/**
	 * Deletes a SubDomain
	 *
	 * @param string $domainName the domain name of the webhosting package to delete the SubDomain for
	 * @param Transip_SubDomain $subDomain SubDomain object to delete
	 */
	public static function deleteSubdomain($domainName, $subDomain)
	{
		return $this->_getSoapClient(array_merge(array($domainName, $subDomain), array('__method' => 'deleteSubdomain')))->deleteSubdomain($domainName, $subDomain);
	}
}