<?php

namespace RafflePrizes\interfaces\services\raffleService;

use RafflePrizes\interfaces\services\raffleService\model\WinnableInterface;

interface RaffleServiceInterface
{
    /**
     * @return WinnableInterface
     */
    public function getRandomPrize(): WinnableInterface;
}