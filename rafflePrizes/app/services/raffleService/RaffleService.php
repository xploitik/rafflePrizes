<?php

namespace RafflePrizes\services\raffleService;

use RafflePrizes\interfaces\services\raffleService\model\WinnableInterface;
use RafflePrizes\interfaces\services\raffleService\PrizeFactoryInterface;
use RafflePrizes\interfaces\services\raffleService\RaffleServiceInterface;
use RafflePrizes\utils\CommonHelper;

class RaffleService implements RaffleServiceInterface
{
    /** @var array */
    protected $prizeFactories = [];

    /**
     * RaffleService constructor.
     * @param array $prizeFactories
     */
    public function __construct(array $prizeFactories)
    {
        $this->prizeFactories = $prizeFactories;
    }

    public function getRandomPrize(): WinnableInterface
    {
        $prizeFactoryIndex = CommonHelper::random(0, (sizeof($this->prizeFactories) - 1));

        /** @var PrizeFactoryInterface $prizeFactory */
        $prizeFactory = $this->prizeFactories[$prizeFactoryIndex];

        return $prizeFactory->createPrize();
    }
}