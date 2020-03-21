<?php

namespace RafflePrizes\interfaces\services\userService;

interface UserServiceInterface
{
    /**
     * @param int $id
     * @return null|model\UserInterface
     */
    public function getById(int $id): ?model\UserInterface;

    /**
     * @param string $email
     * @return null|model\UserInterface
     */
    public function getByEmail(string $email): ?model\UserInterface;

    /**
     * @param array $data
     * @return bool
     */
    public function add(array $data): bool;
}