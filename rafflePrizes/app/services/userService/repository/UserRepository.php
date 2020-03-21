<?php

namespace RafflePrizes\services\userService\repository;

use RafflePrizes\interfaces\services\userService\model\UserInterface;
use RafflePrizes\interfaces\services\userService\UserRepositoryInterface;
use  RafflePrizes\services\userService\model\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param array $data
     * @return UserInterface
     */
    public function createModel(array $data = []): UserInterface
    {
        return new User($data);
    }

    /**
     * @param int $id
     * @return null|UserInterface
     */
    public function findById(int $id): ?UserInterface
    {
        $user = User::findFirst($id);
        if (empty($user)) {
            return null;
        }

        return $this->createModel($user->toArray());
    }

    /**
     * @param array $params
     * @return null|UserInterface
     */
    public function find(array $params): ?UserInterface
    {
        $user = User::findFirst($params);
        if (empty($user)) {
            return null;
        }

        return $this->createModel($user->toArray());
    }

    public function save(UserInterface $user): bool
    {
        /** @var User $user */
        if ($user->save()) {
            $user->refresh();
            return true;
        }

        return false;
    }
}