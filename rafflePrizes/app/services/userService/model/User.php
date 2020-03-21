<?php

namespace RafflePrizes\services\userService\model;

use Phalcon\Mvc\Model;
use RafflePrizes\interfaces\services\userService\model\UserInterface;

/**
 * Class User
 * @package RafflePrizes\services\userService\model
 */
class User extends Model implements UserInterface
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /** @var string */
    protected $email;

    /** @var int */
    protected $balance;

    /** @var int */
    protected $loyalty;

    /** @var string */
    protected $password;

    public function initialize()
    {
        $this->setSource('users');
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
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return int
     */
    public function getBalance(): int
    {
        return $this->balance;
    }

    /**
     * @return int
     */
    public function getLoyalty(): int
    {
        return $this->loyalty;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}