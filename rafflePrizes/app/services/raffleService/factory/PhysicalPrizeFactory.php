<?php

namespace RafflePrizes\services\raffleService\factory;

use RafflePrizes\interfaces\services\deliveryService\DeliveryServiceInterface;
use RafflePrizes\interfaces\services\raffleService\model\WinnableInterface;
use RafflePrizes\interfaces\services\raffleService\PrizeFactoryInterface;
use RafflePrizes\interfaces\services\thingsService\model\ThingInterface;
use RafflePrizes\services\raffleService\factory\prizes\PhysicalPrize;
use RafflePrizes\utils\CommonHelper;

class PhysicalPrizeFactory implements PrizeFactoryInterface
{
    /** @var DeliveryServiceInterface */
    protected $deliveryService;

    /** @var array */
    protected $things;

    /**
     * PhysicalPrizeFactory constructor.
     * @param DeliveryServiceInterface $deliveryService
     * @param array $things
     */
    public function __construct(DeliveryServiceInterface $deliveryService, array $things)
    {
        $this->deliveryService = $deliveryService;
        $this->things = $things;
    }

    /**
     * @return WinnableInterface
     */
    public function createPrize(): WinnableInterface
    {
        $thingIndex = CommonHelper::random(0, (sizeof($this->things) - 1));

        /** @var ThingInterface $thing */
        $thing = $this->things[$thingIndex];

        $prize = new PhysicalPrize([
            'thing_id' => $thing->getId(),
            'date_create' => CommonHelper::currentDateTime(),
        ]);
        $prize->setDeliveryService($this->deliveryService);
        $prize->setSize($thing->getSize());
        $prize->setWeight($thing->getWeight());

        $prize->save();
        $prize->refresh();

        return $prize;
    }
}