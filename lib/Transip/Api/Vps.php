<?php

namespace Transip\Api;

/**
 * This is the API endpoint for the VpsService
 *
 * @package Transip
 * @class   VpsService
 * @author  TransIP (support@transip.nl)
 * @author  Peter Steenbergen (psteenbergen@gmail.com)
 */
class Vps extends SoapClientAbstract
{
    const CANCELLATIONTIME_END = 'end';
    const CANCELLATIONTIME_IMMEDIATELY = 'immediately';

    /** The SOAP service that corresponds with this class. */
    protected $service = 'VpsService';

    /**
     * Gets the singleton SoapClient which is used to connect to the TransIP Api.
     *
     * @param  mixed $parameters Parameters.
     * @return \SoapClient       The SoapClient object to which we can connect to the TransIP API
     */
    protected function getSoapClient($parameters = array())
    {
        $classMap = array(
            'Product'         => 'Transip\\Model\\Product',
            'PrivateNetwork'  => 'Transip\\Model\\PrivateNetwork',
            'Vps'             => 'Transip\\Model\\Vps',
            'Snapshot'        => 'Transip\\Model\\Snapshot',
            'OperatingSystem' => 'Transip\\Model\\OperatingSystem',
        );

        return $this->soapClient($classMap, $parameters);
    }

    /**
     * Get available VPS products
     *
     * @return \Transip\Model\Product[] List of available VPS Products
     */
    public function getAvailableProducts()
    {
        return $this->getSoapClient(array_merge(array(), array('__method' => 'getAvailableProducts')))->getAvailableProducts();
    }

    /**
     * Get available VPS addons
     *
     * @return |Transip\Model\Product[] List of available VPS Products
     */
    public function getAvailableAddons()
    {
        return $this->getSoapClient(array_merge(array(), array('__method' => 'getAvailableAddons')))->getAvailableAddons();
    }

    /**
     * Get all the Active Addons for Vps
     *
     * @param string $vpsName The name of the VPS
     * @return |Transip\Model\Product[] List of available VPS Products
     */
    public function getActiveAddonsForVps($vpsName)
    {
        return $this->getSoapClient(array_merge(array($vpsName), array('__method' => 'getActiveAddonsForVps')))->getActiveAddonsForVps($vpsName);
    }

    /**
     * Get available VPS upgrades for a specific Vps
     *
     * @param string $vpsName The name of the VPS
     * @return |Transip\Model\Product[] List of available VPS Products
     */
    public function getAvailableUpgrades($vpsName)
    {
        return $this->getSoapClient(array_merge(array($vpsName), array('__method' => 'getAvailableUpgrades')))->getAvailableUpgrades($vpsName);
    }

    /**
     * Get available Addons for Vps
     *
     * @param string $vpsName The name of the VPS
     * @return |Transip\Model\Product[] List of available VPS Products
     */
    public function getAvailableAddonsForVps($vpsName)
    {
        return $this->getSoapClient(array_merge(array($vpsName), array('__method' => 'getAvailableAddonsForVps')))->getAvailableAddonsForVps($vpsName);
    }

    /**
     * Get cancellable addons for specific Vps
     *
     * @param string $vpsName The name of the Vps
     * @return |Transip\Model\Product[] List of available Vps Products
     */
    public function getCancellableAddonsForVps($vpsName)
    {
        return $this->getSoapClient(array_merge(array($vpsName), array('__method' => 'getCancellableAddonsForVps')))->getCancellableAddonsForVps($vpsName);
    }

    /**
     * Order a VPS with optional Addons
     *
     * @param string $productName Name of the product
     * @param string[] $addons array with additional addons
     * @param string $operatingSystemName The name of the operatingSystem to install
     * @param string $hostname The name for the host
     * @throws ApiException on error
     */
    public function orderVps($productName, $addons, $operatingSystemName, $hostname)
    {
        return $this->getSoapClient(array_merge(array($productName, $addons, $operatingSystemName, $hostname), array('__method' => 'orderVps')))->orderVps($productName, $addons, $operatingSystemName, $hostname);
    }

    /**
     * Order addons to a VPS
     *
     * @param string $vpsName The name of the VPS
     * @param string[] $addons Array with Addons
     * @throws ApiException on error
     */
    public function orderAddon($vpsName, $addons)
    {
        return $this->getSoapClient(array_merge(array($vpsName, $addons), array('__method' => 'orderAddon')))->orderAddon($vpsName, $addons);
    }

    /**
     * Order a private Network
     *
     * @throws ApiException on error
     */
    public function orderPrivateNetwork()
    {
        return $this->getSoapClient(array_merge(array(), array('__method' => 'orderPrivateNetwork')))->orderPrivateNetwork();
    }

    /**
     * upgrade a Vps
     *
     * @param string $vpsName The name of the VPS
     * @param string $upgradeToProductName The name of the product to upgrade to
     * @throws ApiException on error
     */
    public function upgradeVps($vpsName, $upgradeToProductName)
    {
        return $this->getSoapClient(array_merge(array($vpsName, $upgradeToProductName), array('__method' => 'upgradeVps')))->upgradeVps($vpsName, $upgradeToProductName);
    }

    /**
     * Cancel a Vps
     *
     * @param string $vpsName The vps to cancel
     * @param string $endTime The time to cancel the vps (VpsService::CANCELLATIONTIME_END (end of contract)
     * @throws ApiException on error
     */
    public function cancelVps($vpsName, $endTime)
    {
        return $this->getSoapClient(array_merge(array($vpsName, $endTime), array('__method' => 'cancelVps')))->cancelVps($vpsName, $endTime);
    }

    /**
     * Cancel a Vps Addon
     *
     * @param string $vpsName The vps to cancel
     * @param string $addonName name of the addon
     * @throws ApiException on error
     */
    public function cancelAddon($vpsName, $addonName)
    {
        return $this->getSoapClient(array_merge(array($vpsName, $addonName), array('__method' => 'cancelAddon')))->cancelAddon($vpsName, $addonName);
    }

    /**
     * Cancel a PrivateNetwork
     *
     * @param string $privateNetworkName the name of the private network to cancel
     * @param string $endTime The time to cancel the vps (VpsService::CANCELLATIONTIME_END (end of contract)
     * @throws ApiException on error
     */
    public function cancelPrivateNetwork($privateNetworkName, $endTime)
    {
        return $this->getSoapClient(array_merge(array($privateNetworkName, $endTime), array('__method' => 'cancelPrivateNetwork')))->cancelPrivateNetwork($privateNetworkName, $endTime);
    }

    /**
     * Get Private networks for a specific vps
     *
     * @param string $vpsName The name of the VPS
     * @return |Transip\Model\PrivateNetwork[] $privateNetworks Array of PrivateNetwork objects
     */
    public function getPrivateNetworksByVps($vpsName)
    {
        return $this->getSoapClient(array_merge(array($vpsName), array('__method' => 'getPrivateNetworksByVps')))->getPrivateNetworksByVps($vpsName);
    }

    /**
     * Get all Private networks in your account
     *
     * @return |Transip\Model\PrivateNetwork[] $privateNetworks Array of PrivateNetwork objects
     */
    public function getAllPrivateNetworks()
    {
        return $this->getSoapClient(array_merge(array(), array('__method' => 'getAllPrivateNetworks')))->getAllPrivateNetworks();
    }

    /**
     * Add VPS to a private Network
     *
     * @param string $vpsName The name of the VPS
     * @param string $privateNetworkName The name of the privateNetwork to add to
     */
    public function addVpsToPrivateNetwork($vpsName, $privateNetworkName)
    {
        return $this->getSoapClient(array_merge(array($vpsName, $privateNetworkName), array('__method' => 'addVpsToPrivateNetwork')))->addVpsToPrivateNetwork($vpsName, $privateNetworkName);
    }

    /**
     * Remove VPS from a private Network
     *
     * @param string $vpsName The name of the VPS
     * @param string $privateNetworkName The name of the private Network
     */
    public function removeVpsFromPrivateNetwork($vpsName, $privateNetworkName)
    {
        return $this->getSoapClient(array_merge(array($vpsName, $privateNetworkName), array('__method' => 'removeVpsFromPrivateNetwork')))->removeVpsFromPrivateNetwork($vpsName, $privateNetworkName);
    }

    /**
     * Get total amount of traffic used this month
     *
     * @param string $vpsName The name of the VPS
     * @deprecated replaced by getTrafficInformationForVps()
     * @throws ApiException on error
     * @return float $amountOfTraffic Amount of traffic in Bytes
     */
    public function getAmountOfTrafficUsed($vpsName)
    {
        return $this->getSoapClient(array_merge(array($vpsName), array('__method' => 'getAmountOfTrafficUsed')))->getAmountOfTrafficUsed($vpsName);
    }

    /**
     * Get Traffic information by vpsName for this contractPeriod
     *
     * @param string $vpsName The name of the VPS
     * @throws ApiException on error
     * @return array
     */
    public function getTrafficInformationForVps($vpsName)
    {
        return $this->getSoapClient(array_merge(array($vpsName), array('__method' => 'getTrafficInformationForVps')))->getTrafficInformationForVps($vpsName);
    }

    /**
     * Start a Vps
     *
     * @param string $vpsName The vps name
     * @throws ApiException on error
     */
    public function start($vpsName)
    {
        return $this->getSoapClient(array_merge(array($vpsName), array('__method' => 'start')))->start($vpsName);
    }

    /**
     * Stop a Vps
     *
     * @param string $vpsName The vps name
     * @throws ApiException on error
     */
    public function stop($vpsName)
    {
        return $this->getSoapClient(array_merge(array($vpsName), array('__method' => 'stop')))->stop($vpsName);
    }

    /**
     * Reset a Vps
     *
     * @param string $vpsName The vps name
     * @throws ApiException on error
     */
    public function reset($vpsName)
    {
        return $this->getSoapClient(array_merge(array($vpsName), array('__method' => 'reset')))->reset($vpsName);
    }

    /**
     * Create a snapshot
     *
     * @param string $vpsName The vps name
     * @param string $description The snapshot description
     * @throws ApiException on error
     */
    public function createSnapshot($vpsName, $description)
    {
        return $this->getSoapClient(array_merge(array($vpsName, $description), array('__method' => 'createSnapshot')))->createSnapshot($vpsName, $description);
    }

    /**
     * Revert a snapshot
     *
     * @param string $vpsName The vps name
     * @param string $snapshotName The snapshot name
     * @throws ApiException on error
     */
    public function revertSnapshot($vpsName, $snapshotName)
    {
        return $this->getSoapClient(array_merge(array($vpsName, $snapshotName), array('__method' => 'revertSnapshot')))->revertSnapshot($vpsName, $snapshotName);
    }

    /**
     * Remove a snapshot
     *
     * @param string $vpsName The vps name
     * @param string $snapshotName The snapshot name
     * @throws ApiException on error
     */
    public function removeSnapshot($vpsName, $snapshotName)
    {
        return $this->getSoapClient(array_merge(array($vpsName, $snapshotName), array('__method' => 'removeSnapshot')))->removeSnapshot($vpsName, $snapshotName);
    }

    /**
     * Get a Vps by name
     *
     * @param string $vpsName The vps name
     * @return |Transip\Model\Vps $vps    The vps objects
     */
    public function getVps($vpsName)
    {
        return $this->getSoapClient(array_merge(array($vpsName), array('__method' => 'getVps')))->getVps($vpsName);
    }

    /**
     * Get all Vpses
     *
     * @return |Transip\Model\Vps[] Array of Vps objects
     */
    public function getVpses()
    {
        return $this->getSoapClient(array_merge(array(), array('__method' => 'getVpses')))->getVpses();
    }

    /**
     * Get all Snapshots for a vps
     *
     * @param string $vpsName The name of the VPS
     * @return |Transip\Model\Snapshot[] $snapshotArray Array of snapshot objects
     */
    public function getSnapshotsByVps($vpsName)
    {
        return $this->getSoapClient(array_merge(array($vpsName), array('__method' => 'getSnapshotsByVps')))->getSnapshotsByVps($vpsName);
    }

    /**
     * Get all operating systems
     *
     * @return |Transip\Model\OperatingSystem[] Array of OperatingSystem objects
     */
    public function getOperatingSystems()
    {
        return $this->getSoapClient(array_merge(array(), array('__method' => 'getOperatingSystems')))->getOperatingSystems();
    }

    /**
     * Install an operating system on a vps
     *
     * @param string $vpsName The name of the VPS
     * @param string $operatingSystemName The name of the operating to install
     * @param string $hostname preinstallable Only
     */
    public function installOperatingSystem($vpsName, $operatingSystemName, $hostname)
    {
        return $this->getSoapClient(array_merge(array($vpsName, $operatingSystemName, $hostname), array('__method' => 'installOperatingSystem')))->installOperatingSystem($vpsName, $operatingSystemName, $hostname);
    }

    /**
     * Get Ips for a specific Vps
     *
     * @param string $vpsName The name of the Vps
     * @return string[] $ipAddresses Array of ipAddresses
     */
    public function getIpsForVps($vpsName)
    {
        return $this->getSoapClient(array_merge(array($vpsName), array('__method' => 'getIpsForVps')))->getIpsForVps($vpsName);
    }

    /**
     * Get All ips
     *
     * @return string[] $ipAddresses Array of ipAddresses
     */
    public function getAllIps()
    {
        return $this->getSoapClient(array_merge(array(), array('__method' => 'getAllIps')))->getAllIps();
    }

    /**
     * Add Ipv6 Address to Vps
     *
     * @param string $vpsName The name of the VPS
     * @param string $ipv6Address The Ipv6 Address from your range
     * @throws ApiException on error
     */
    public function addIpv6ToVps($vpsName, $ipv6Address)
    {
        return $this->getSoapClient(array_merge(array($vpsName, $ipv6Address), array('__method' => 'addIpv6ToVps')))->addIpv6ToVps($vpsName, $ipv6Address);
    }

    /**
     * Update PTR record (reverse DNS) for an ipAddress
     *
     * @param string $ipAddress The IP Address to update (ipv4 or ipv6)
     * @param string $ptrRecord The PTR Record to update to
     * @throws ApiException on error
     */
    public function updatePtrRecord($ipAddress, $ptrRecord)
    {
        return $this->getSoapClient(array_merge(array($ipAddress, $ptrRecord), array('__method' => 'updatePtrRecord')))->updatePtrRecord($ipAddress, $ptrRecord);
    }

    /**
     * Enable or Disable a Customer Lock for a Vps
     *
     * @param string $vpsName The name of the Vps
     * @param boolean $enabled Enable (true) or Disable (false) the lock
     * @throws ApiException on error
     */
    public function setCustomerLock($vpsName, $enabled)
    {
        return $this->getSoapClient(array_merge(array($vpsName, $enabled), array('__method' => 'setCustomerLock')))->setCustomerLock($vpsName, $enabled);
    }

    /**
     * Handover a VPS to another TransIP User
     *
     * @param string $vpsName The name of the Vps
     * @param string $targetAccountname the target account name
     * @throws ApiException on error
     */
    public function handoverVps($vpsName, $targetAccountname)
    {
        return $this->getSoapClient(array_merge(array($vpsName, $targetAccountname), array('__method' => 'handoverVps')))->handoverVps($vpsName, $targetAccountname);
    }
}