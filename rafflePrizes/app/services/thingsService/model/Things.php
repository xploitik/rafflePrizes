<?php

namespace RafflePrizes\services\thingsService\model;

use Phalcon\Mvc\Model;
use RafflePrizes\interfaces\services\thingsService\model\ThingInterface;

/**
 * Class User
 * @package RafflePrizes\services\thingsService\model
 */
class Things extends Model implements ThingInterface
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /** @var int */
    protected $size;

    /** @var int */
    protected $weight;

    public function initialize()
    {
        $this->setSource('things');
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }
}