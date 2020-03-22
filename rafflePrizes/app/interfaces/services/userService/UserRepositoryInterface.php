<?php

namespace RafflePrizes\interfaces\services\userService;

use RafflePrizes\interfaces\services\userService\model\UserInterface;

interface UserRepositoryInterface
{
    /**
     * @param array $data
     * @return UserInterface
     */
    public function createModel(array $data = []): UserInterface;

    /**
     * @param int $id
     * @return null|UserInterface
     */
    public function findById(int $id): ?UserInterface;

    /**
     * @param array $params
     * @return null|UserInterface
     */
    public function find(array $params): ?UserInterface;

    /**
     * @param UserInterface $user
     * @param array $data
     * @return bool
     */
    public function save(UserInterface $user, array $data = []): bool;
}