<?php

namespace RafflePrizes\interfaces\services\thingsService;

use RafflePrizes\interfaces\services\thingsService\model\ThingInterface;

interface ThingsServiceInterface
{
    /**
     * @return ThingInterface[]
     */
    public function getAll(): array;
}

