<?php

namespace RafflePrizes\services\raffleService\factory;

use RafflePrizes\interfaces\services\raffleService\model\WinnableInterface;
use RafflePrizes\interfaces\services\raffleService\PrizeFactoryInterface;
use RafflePrizes\interfaces\services\userService\UserServiceInterface;
use RafflePrizes\services\raffleService\factory\prizes\MoneyPrize;
use RafflePrizes\utils\CommonHelper;

class MoneyPrizeFactory implements PrizeFactoryInterface
{
    /** @var UserServiceInterface */
    protected $userService;

    /** @var int */
    protected $minAmount;

    /** @var int */
    protected $maxAmount;

    /**
     * MoneyPrizeFactory constructor.
     * @param UserServiceInterface $userService
     * @param int $minAmount
     * @param int $maxAmount
     */
    public function __construct(UserServiceInterface $userService, $minAmount, $maxAmount)
    {
        $this->userService = $userService;
        $this->minAmount = $minAmount;
        $this->maxAmount = $maxAmount;
    }

    /**
     * @return WinnableInterface
     */
    public function createPrize(): WinnableInterface
    {
        $amount = CommonHelper::random($this->minAmount, $this->maxAmount);
        $prize = new MoneyPrize([
            'amount' => $amount,
            'date_create' => CommonHelper::currentDateTime(),
        ]);
        $prize->setUserService($this->userService);

        $prize->save();
        $prize->refresh();

        return $prize;
    }
}