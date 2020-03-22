<?php

namespace RafflePrizes\interfaces\services\deliveryService;

use RafflePrizes\interfaces\services\deliveryService\model\DeliverableInterface;
use RafflePrizes\interfaces\services\userService\model\UserInterface;

interface DeliveryServiceInterface
{
    /**
     * @param UserInterface $user
     * @param DeliverableInterface $delivery
     * @return bool
     */
    public function delivery(UserInterface $user, DeliverableInterface $delivery): bool;
}