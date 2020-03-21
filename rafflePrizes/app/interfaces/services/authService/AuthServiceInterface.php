<?php

namespace RafflePrizes\interfaces\services\authService;

interface AuthServiceInterface
{
    /**
     * @return bool
     */
    public function isAuthentication(): bool;

    /**
     * @param string $mail
     * @param string $password
     * @return bool
     */
    public function login(string $mail, string $password): bool;

    /**
     * @return bool
     */
    public function logout(): bool;
}