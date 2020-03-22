<?php

namespace RafflePrizes\services\raffleService\factory;

use RafflePrizes\interfaces\services\raffleService\model\WinnableInterface;
use RafflePrizes\interfaces\services\raffleService\PrizeFactoryInterface;
use RafflePrizes\interfaces\services\userService\UserServiceInterface;
use RafflePrizes\services\raffleService\factory\prizes\LoyaltyPrize;
use RafflePrizes\utils\CommonHelper;

class LoyaltyPrizeFactory implements PrizeFactoryInterface
{
    /** @var UserServiceInterface */
    protected $userService;

    /** @var int */
    protected $minAmount;

    /** @var int */
    protected $maxAmount;

    /** @var string */
    protected $source;

    /**
     * LoyaltyPrizeFactory constructor.
     * @param UserServiceInterface $userService
     * @param int $minAmount
     * @param int $maxAmount
     * @param string $source
     */
    public function __construct(UserServiceInterface $userService, $minAmount, $maxAmount, $source)
    {
        $this->userService = $userService;
        $this->minAmount = $minAmount;
        $this->maxAmount = $maxAmount;
        $this->source = $source;
    }

    /**
     * @return WinnableInterface
     */
    public function createPrize(): WinnableInterface
    {
        $amount = CommonHelper::random($this->minAmount, $this->maxAmount);
        $prize = new LoyaltyPrize([
            'amount' => $amount,
            'date_create' => CommonHelper::currentDateTime(),
            'source_name' => $this->source,
        ]);
        $prize->setUserService($this->userService);

        $prize->save();
        $prize->refresh();

        return $prize;
    }
}