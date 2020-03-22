<?php

namespace RafflePrizes\interfaces\services\deliveryService\model;

interface DeliverableInterface
{
    /**
     * @return int
     */
    public function getSize(): int;

    /**
     * @return int
     */
    public function getWeight(): int;
}