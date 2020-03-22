<?php

namespace RafflePrizes\interfaces\services\raffleService\model;

use RafflePrizes\interfaces\services\userService\model\UserInterface;

interface WinnableInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param UserInterface $user
     */
    public function bindTo(UserInterface $user): void;

    /**
     * @param UserInterface $user
     */
    public function apply(UserInterface $user): void;
}