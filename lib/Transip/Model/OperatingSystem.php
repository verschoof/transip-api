<?php

namespace Transip\Model;

/**
 * This class models an Operating System
 *
 * @package Transip
 * @class OperatingSystem
 * @author TransIP (support@transip.nl)
 */
class OperatingSystem
{
	/**
	 * The operating system name
	 *
	 * @var string
	 */
	public $name = '';

	/**
	 * Description
	 *
	 * @var string
	 */
	public $description = '';

	/**
	 * The snapshot creation date
	 *
	 * @var string
	 */
	public $dateTimeCreate = '';

	/**
	 * Is a preinstallable image
	 *
	 * @var boolean
	 */
	public $isPreinstallableImage = false;
}