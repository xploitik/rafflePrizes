<?php

namespace RafflePrizes\interfaces\services\userService\model;

interface UserInterface
{
    /**
     * @return int
     */
    public function getId(): int ;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @return int
     */
    public function getBalance(): int;

    /**
     * @return int
     */
    public function getLoyalty(): int;

    /**
     * @return string
     */
    public function getPassword(): string;
}