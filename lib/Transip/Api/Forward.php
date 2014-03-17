<?php

namespace Transip\Api;

/**
 * This is the API endpoint for the ForwardService
 *
 * @package Transip
 * @class ForwardService
 * @author TransIP (support@transip.nl)
 * @author Mitchel Verschoof (mitchel@verschoof.net)
 * @version 20131025 10:01
 */
class Forward extends SoapClientAbstract
{
	const CANCELLATIONTIME_END         = 'end';
	const CANCELLATIONTIME_IMMEDIATELY = 'immediately';

	/** The SOAP service that corresponds with this class. */
	protected $service = 'ForwardService';


	/**
	 * Gets the singleton SoapClient which is used to connect to the TransIP Api.
	 *
	 * @param  mixed       $parameters  Parameters.
	 * @return SoapClient               The SoapClient object to which we can connect to the TransIP API
	 */
	public static function _getSoapClient($parameters = array())
	{
		$classMap = array(
			'Forward' => 'Transip\\Model\\Forward',
		);

		return $this->soapClient($classMap, $parameters);
	}

	/**
	 * Gets a list of all domains which have the Forward option enabled.
	 *
	 * @return string[] A list of all forwards enabled domains for the user
	 */
	public static function getForwardDomainNames()
	{
		return self::_getSoapClient(array_merge(array(), array('__method' => 'getForwardDomainNames')))->getForwardDomainNames();
	}

	/**
	 * Gets information about a forwarded domain
	 *
	 * @param string $forwardDomainName The domain to get the info for
	 * @return Transip_Forward Forward object with all info if found, an exception otherwise
	 */
	public static function getInfo($forwardDomainName)
	{
		return self::_getSoapClient(array_merge(array($forwardDomainName), array('__method' => 'getInfo')))->getInfo($forwardDomainName);
	}

	/**
	 * Order webhosting for a domain name
	 *
	 * @param Transip_Forward $forward info about the forward to order. Mandatory fields are $domainName. Other fields are optional.
	 */
	public static function order($forward)
	{
		return self::_getSoapClient(array_merge(array($forward), array('__method' => 'order')))->order($forward);
	}

	/**
	 * Cancel webhosting for a domain
	 *
	 * @param string $forwardDomainName The domain name of the forward to cancel the forwarding service for
	 * @param string $endTime the time to cancel the domain (ForwardService::CANCELLATIONTIME_END (end of contract) or ForwardService::CANCELLATIONTIME_IMMEDIATELY (as soon as possible))
	 */
	public static function cancel($forwardDomainName, $endTime)
	{
		return self::_getSoapClient(array_merge(array($forwardDomainName, $endTime), array('__method' => 'cancel')))->cancel($forwardDomainName, $endTime);
	}

	/**
	 * Modify the options of a Forward. All fields set in the Forward object will be changed.
	 *
	 * @param Transip_Forward $forward The forward to modify
	 */
	public static function modify($forward)
	{
		return self::_getSoapClient(array_merge(array($forward), array('__method' => 'modify')))->modify($forward);
	}
}