<?php

namespace RafflePrizes\services\raffleService\factory\prizes;

use Phalcon\Mvc\Model;
use RafflePrizes\interfaces\services\deliveryService\DeliveryServiceInterface;
use RafflePrizes\interfaces\services\deliveryService\model\DeliverableInterface;
use RafflePrizes\interfaces\services\raffleService\model\WinnableInterface;
use RafflePrizes\interfaces\services\userService\model\UserInterface;
use RafflePrizes\utils\CommonHelper;

class PhysicalPrize extends Model implements WinnableInterface, DeliverableInterface
{
    /**
     * TODO: перенести в таблицу
     */
    protected const NAME = 'физический предмет';

    /** @var DeliveryServiceInterface */
    protected $deliveryService;

    /** @var int */
    protected $size;

    /** @var int */
    protected $weight;

    public function initialize()
    {
        $this->setSource('storage');
    }

    public function bindTo(UserInterface $user): void
    {
        $this->save(['bindTo' => $user->getId()]);
        $this->refresh();
    }

    public function apply(UserInterface $user): void
    {
        if (!$this->deliveryService instanceof DeliveryServiceInterface) {
            return;
        }

        $this->deliveryService->delivery($user, $this);

        $this->save([
            'used' => 1,
            'date_send' => CommonHelper::currentDateTime(),
        ]);
        $this->refresh();
    }

    /**
     * @param DeliveryServiceInterface $deliveryService
     */
    public function setDeliveryService(DeliveryServiceInterface $deliveryService)
    {
        $this->deliveryService = $deliveryService;
    }

    /**
     * @param int $size
     */
    public function setSize(int $size)
    {
        $this->size = $size;
    }

    /**
     * @param int $weight
     */
    public function setWeight(int $weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return self::NAME;
    }
}