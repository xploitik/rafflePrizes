<?php

namespace RafflePrizes\interfaces\services\raffleService;

use RafflePrizes\interfaces\services\raffleService\model\WinnableInterface;

interface PrizeFactoryInterface
{
    /**
     * @return WinnableInterface
     */
    public function createPrize(): WinnableInterface;
}