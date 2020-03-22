<?php

namespace RafflePrizes\interfaces\services\thingsService\model;

use RafflePrizes\interfaces\services\deliveryService\model\DeliverableInterface;

interface ThingInterface extends DeliverableInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getName(): string;
}

