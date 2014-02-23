<?php

namespace Transip;

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
        'readwrote'
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

    public function __construct($login, $privateKey, $debug = false)
    {
        $this->login      = $login;
        $this->privateKey = $privateKey;

        if ($debug) {
            $this->mode = 'readonly';
        }
    }

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
            case 'Colocation':
                $api = new Api\Colocation($this);
                break;

            default:
                throw new InvalidArgumentException(sprintf('Undefined api instance called: "%s"', $name));
        }

        return $api;
    }

    public function getEndPoint()
    {
        return $this->endpoint;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getPrivateKey()
    {
        return $this->privateKey;
    }

    public function getMode()
    {
        return $this->mode;
    }

    public function setMode($mode)
    {
        if (in_array($mode, $availableModes)) {
            $this->mode = $mode;
        }

        throw new Exception("$mode is not a available mode for this API.");

    }
}