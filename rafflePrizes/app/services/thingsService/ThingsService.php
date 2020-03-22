<?php

namespace RafflePrizes\services\thingsService;

use RafflePrizes\interfaces\services\thingsService\ThingsServiceInterface;
use RafflePrizes\interfaces\services\thingsService\model\ThingInterface;
use RafflePrizes\services\thingsService\model\Things;

class ThingsService implements ThingsServiceInterface
{
    /**
     * @return ThingInterface[]
     */
    public function getAll(): array
    {
        // TODO: объявить как репозитоий
        $thingsRepository = new Things();
        $thingsRaw = $thingsRepository::find();

        $things = [];
        foreach ($thingsRaw as $thingRaw)
        {
            $things[] = $thingRaw;
        }

        return $things;
    }
}