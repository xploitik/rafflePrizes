<?php

namespace RafflePrizes\services\deliveryService;

use RafflePrizes\interfaces\services\deliveryService\DeliveryServiceInterface;
use RafflePrizes\interfaces\services\deliveryService\model\DeliverableInterface;
use RafflePrizes\interfaces\services\userService\model\UserInterface;

class DeliveryService implements DeliveryServiceInterface
{
    /**
     * @param UserInterface $user
     * @param DeliverableInterface $delivery
     * @return bool
     */
    public function delivery(UserInterface $user, DeliverableInterface $delivery): bool
    {
        return $this->sendToCourier($user->getAddress(), $delivery->getSize(), $delivery->getWeight());
    }

    /**
     * @param string $address
     * @param int $size
     * @param int $weight
     * @return bool
     */
    protected function sendToCourier(string $address, int $size, int $weight): bool
    {
        return true;
    }
}