<?php

namespace Transip\Model;

/**
 * This class models a database
 *
 * @package Transip
 * @class Db
 * @author TransIP (support@transip.nl)
 * @version 20131025 10:01
 */
class Db
{
	/**
	 * Database name
	 *
	 * @var string;
	 */
	public $name;

	/**
	 * Username for the database
	 *
	 * @var string
	 */
	public $username;

	/**
	 * Max disk usage for the database
	 *
	 * @var int
	 */
	public $maxDiskUsage;

	/**
	 * Create a Database Object
	 *
	 * @param string $name Database name
	 * @param string $username Database username
	 * @param string $password Database password
	 * @param string $maxDiskUsage maximum size of Database
	 */
	public function __construct($name, $username = '', $maxDiskUsage = 100)
	{
		$this->name = $name;
		$this->username = $username;
		$this->maxDiskUsage = $maxDiskUsage;
	}
}