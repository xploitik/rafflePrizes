<?php

namespace RafflePrizes\services\raffleService\factory\prizes;

use Phalcon\Mvc\Model;
use RafflePrizes\interfaces\services\raffleService\model\WinnableInterface;
use RafflePrizes\interfaces\services\userService\model\UserInterface;
use RafflePrizes\interfaces\services\userService\UserServiceInterface;
use RafflePrizes\utils\CommonHelper;

/**
 * Class LoyaltyPrize
 * @package RafflePrizes\services\raffleService\factory\prizes
 */
class LoyaltyPrize extends Model implements WinnableInterface
{
    /*
     * TODO: перенести в таблицу
     */
    protected const NAME = 'бонусные баллы';

    /** @var UserServiceInterface */
    protected $userService;

    /** @var int */
    protected $amount;

    public function initialize()
    {
        $this->setSource('loyalty');
    }

    /**
     * @param UserInterface $user
     */
    public function bindTo(UserInterface $user): void
    {
        $this->save([
            'bindTo' => $user->getId(),
            'date_bind' => CommonHelper::currentDateTime(),
        ]);

        $this->refresh();
    }

    /**
     * @param UserInterface $user
     */
    public function apply(UserInterface $user): void
    {
        if (!$this->userService instanceof UserServiceInterface) {
            return;
        }

        $loyalty = $this->getAmount() + $user->getLoyalty();
        $this->userService->setLoyalty($user, $loyalty);

        $this->save(['used' => 1]);
        $this->refresh();
    }

    /**
     * @param UserServiceInterface $userService
     */
    public function setUserService(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return self::NAME;
    }
}