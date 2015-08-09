<?php

namespace Transip\Model;

/**
 * This class models a Vps
 *
 * @package Transip
 * @class   Vps
 * @author  TransIP (support@transip.nl)
 */
class Vps
{
	/**
	 * The Vps name
	 *
	 * @var string
	 */
	public $name;

	/**
	 * The Vps description
	 *
	 * @var string
	 */
	public $description;

	/**
	 * The Vps OperatingSystem
	 *
	 * @var string
	 */
	public $operatingSystem;

	/**
	 * The Vps disk size
	 *
	 * @var string
	 */
	public $diskSize;

	/**
	 * The Vps memory size
	 *
	 * @var string
	 */
	public $memorySize;

	/**
	 * The Vps cpu count
	 *
	 * @var string
	 */
	public $cpus;

	/**
	 * The Vps status
	 *
	 * @var string
	 */
	public $status;

	/**
	 * The Vps main ipAddress
	 *
	 * @var string
	 */
	public $ipAddress;

	/**
	 * The Vps VNC hostname
	 *
	 * @var string
	 */
	public $vncHostname;

	/**
	 * The Vps VNC port (uses SSL)
	 *
	 * @var string
	 */
	public $vncPortNumber;

	/**
	 * The Vps VNC password
	 *
	 * @var string
	 */
	public $vncPassword;

	/**
	 * If the vps is blocked
	 *
	 * @var string
	 */
	public $isBlocked;

	/**
	 * If this vps is customer locked
	 *
	 * @var boolean
	 */
	public $isCustomerLocked;
}