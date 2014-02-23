<?php

namespace Transip\Api;

/**
 * This is the API endpoint for the ColocationService
 *
 * @package Transip
 * @class ColocationService
 * @author TransIP (support@transip.nl)
 * @author Mitchel Verschoof (mitchel@verschoof.net)
 * @version 20131025 10:01
 */
class Colocation extends SoapClientAbstract
{
	/** The SOAP service that corresponds with this class. */
	protected $service = 'ColocationService';


	/**
	 * Gets the singleton SoapClient which is used to connect to the TransIP Api.
	 *
	 * @param  mixed       $parameters  Parameters.
	 * @return SoapClient               The SoapClient object to which we can connect to the TransIP API
	 */
	public static function _getSoapClient($parameters = array())
	{
		$classMap = array(
			'DataCenterVisitor' => 'Transip_DataCenterVisitor',
		);

		return $this->soapClient($classMap, $parameters);
	}

	/**
	 * Requests access to the data-center
	 *
	 * @param string $when the datetime of the wanted datacenter access, in YYYY-MM-DD hh:mm:ss format
	 * @param int $duration the expected duration of the visit, in minutes
	 * @param string[] $visitors the names of the visitors for this data-center visit, must be at least 1 and at most 20
	 * @param string $phoneNumber if an SMS with access codes needs to be sent, set the phonenumber of the receiving phone here;
	 * @return Transip_DataCenterVisitor[] An array of Visitor objects holding information (such as reservation and access number) about
	 */
	public static function requestAccess($when, $duration, $visitors, $phoneNumber)
	{
		return self::_getSoapClient(array_merge(array($when, $duration, $visitors, $phoneNumber), array('__method' => 'requestAccess')))->requestAccess($when, $duration, $visitors, $phoneNumber);
	}

	/**
	 * Request remote hands to the data-center
	 *
	 * @param string $coloName The name of the colocation
	 * @param string $contactName The contact name
	 * @param string $phoneNumber Phone number to contact
	 * @param int $expectedDuration Expected duration of the job in minutes
	 * @param string $instructions What to do
	 */
	public static function requestRemoteHands($coloName, $contactName, $phoneNumber, $expectedDuration, $instructions)
	{
		return self::_getSoapClient(array_merge(array($coloName, $contactName, $phoneNumber, $expectedDuration, $instructions), array('__method' => 'requestRemoteHands')))->requestRemoteHands($coloName, $contactName, $phoneNumber, $expectedDuration, $instructions);
	}

	/**
	 * Get coloNames for customer
	 *
	 * @return string[] Array with colo names
	 */
	public static function getColoNames()
	{
		return self::_getSoapClient(array_merge(array(), array('__method' => 'getColoNames')))->getColoNames();
	}

	/**
	 * Get IpAddresses that are active and assigned to a Colo.
	 * Both ipv4 and ipv6 addresses are returned: ipv4 adresses in dot notation,
	 * ipv6 addresses in ipv6 presentation.
	 *
	 * @param string $coloName The name of the colo to get the ipaddresses for for
	 * @return string[] Array with assigned IPv4 and IPv6 addresses for the colo
	 */
	public static function getIpAddresses($coloName)
	{
		return self::_getSoapClient(array_merge(array($coloName), array('__method' => 'getIpAddresses')))->getIpAddresses($coloName);
	}

	/**
	 * Get ipranges that are assigned to a Colo. Both ipv4 and ipv6 ranges are
	 * returned, in CIDR notation.
	 *
	 * @param string $coloName The name of the colo to get the ranges for
	 * @see http://en.wikipedia.org/wiki/CIDR_notation
	 * @return string[] Array of ipranges in CIDR format assigned to this colo.
	 */
	public static function getIpRanges($coloName)
	{
		return self::_getSoapClient(array_merge(array($coloName), array('__method' => 'getIpRanges')))->getIpRanges($coloName);
	}

	/**
	 * Adds a new IpAddress, either an ipv6 or an ipv4 address.
	 * The service will validate the address, ensure the user is entitled
	 * to the address and will add the address to the correct Colo and range.
	 *
	 * @param string $ipAddress The IpAddress to create, can be either ipv4 or ipv6.
	 * @param string $reverseDns The RDNS name for this IpAddress
	 */
	public static function createIpAddress($ipAddress, $reverseDns)
	{
		return self::_getSoapClient(array_merge(array($ipAddress, $reverseDns), array('__method' => 'createIpAddress')))->createIpAddress($ipAddress, $reverseDns);
	}

	/**
	 * Deletes an IpAddress currently in use this account.
	 * IpAddress can be either ipv4 or ipv6. The service will validate
	 * if the user has rights to remove the address and will remove it completely,
	 * together with any RDNS or monitoring assigned to the address.
	 *
	 * @param string $ipAddress the IpAddress to delete, can be either ipv4 or ipv6.
	 */
	public static function deleteIpAddress($ipAddress)
	{
		return self::_getSoapClient(array_merge(array($ipAddress), array('__method' => 'deleteIpAddress')))->deleteIpAddress($ipAddress);
	}

	/**
	 * Get the Reverse DNS for an IpAddress assigned to the user
	 * Throws an Exception when the Address does not exist or is not
	 * owned by the user.
	 *
	 * @param string $ipAddress the IpAddress, either ipv4 or ipv6
	 * @return string rdns
	 */
	public static function getReverseDns($ipAddress)
	{
		return self::_getSoapClient(array_merge(array($ipAddress), array('__method' => 'getReverseDns')))->getReverseDns($ipAddress);
	}

	/**
	 * Set the RDNS name for an ipAddress.
	 * Throws an Exception when the Address does not exist or is not
	 * owned by the user.
	 *
	 * @param string $ipAddress The IpAddress to set the reverse dns for, can be either ipv4 or ipv6.
	 * @param string $reverseDns The new reverse DNS, must be a valid RDNS value.
	 */
	public static function setReverseDns($ipAddress, $reverseDns)
	{
		return self::_getSoapClient(array_merge(array($ipAddress, $reverseDns), array('__method' => 'setReverseDns')))->setReverseDns($ipAddress, $reverseDns);
	}
}