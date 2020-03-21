<?php

namespace RafflePrizes\interfaces\raffleService\model;

use RafflePrizes\interfaces\services\userService\model\UserInterface;

interface WinnableInterface
{
    /**
     * @param UserInterface $user
     */
    public function bindTo(UserInterface $user): void;
}