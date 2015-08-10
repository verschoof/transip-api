<?php

namespace Transip\Model;

/**
 * This class models a vps snapshot
 *
 * @package Transip
 * @class Snapshot
 * @author TransIP (support@transip.nl)
 */
class Snapshot
{
    /**
     * The snapshot name
     *
     * @var string
     */
    public $name;

    /**
     * The snapshot description
     *
     * @var string
     */
    public $description;

    /**
     * The snapshot creation date
     *
     * @var string
     */
    public $dateTimeCreate;
}