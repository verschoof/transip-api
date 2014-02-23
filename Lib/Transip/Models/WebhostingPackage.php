<?php

/**
 * This class models a WebhostingPackage
 *
 * @package Transip
 * @class WebhostingPackage
 * @author TransIP (support@transip.nl)
 * @version 20131025 10:01
 */
class Transip_WebhostingPackage
{
	/**
	 * Name of the webhosting package
	 *
	 * @var string
	 */
	public $name;

	/**
	 * Describes this webhosting package
	 *
	 * @var string
	 */
	public $description;

	/**
	 * Price in euros.
	 *
	 * @var float
	 */
	public $price;

	/**
	 * Price for renewing the package in euros.
	 *
	 * @var float
	 */
	public $renewalPrice;
}