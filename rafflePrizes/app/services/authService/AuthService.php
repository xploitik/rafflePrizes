<?php

namespace RafflePrizes\services\authService;

use RafflePrizes\interfaces\infrastructure\session\SessionInterface;
use RafflePrizes\interfaces\services\authService\AuthServiceInterface;
use RafflePrizes\interfaces\services\userService\UserServiceInterface;
use RafflePrizes\utils\SecurityHelper;

class AuthService implements AuthServiceInterface
{
    protected const USER_SESSION__NAME = 'USER';

    /** @var SessionInterface */
    protected $sessionService;

    /** @var UserServiceInterface */
    protected $userService;

    /**
     * AuthService constructor.
     * @param SessionInterface $sessionService
     * @param UserServiceInterface $userService
     */
    public function __construct(SessionInterface $sessionService, UserServiceInterface $userService)
    {
        $this->sessionService = $sessionService;
        $this->userService = $userService;
    }

    /**
     * @return bool
     */
    public function isAuthentication(): bool
    {
        return $this->sessionService->has(self::USER_SESSION__NAME);
    }

    /**
     * @param string $mail
     * @param string $password
     * @return bool
     */
    public function login(string $mail, string $password): bool
    {
        if (empty($mail) || empty($password)) {
            return false;
        }

        $user = $this->userService->getByEmail($mail);
        if (empty($user)) {
            return false;
        }

        if ($user->getPassword() !== SecurityHelper::toHash($password)) {
            return false;
        }

        return $this->sessionService->save(self::USER_SESSION__NAME, [
            'id' => $user->getId()
        ]);
    }

    /**
     * @return bool
     */
    public function logout(): bool
    {
        return $this->sessionService->delete(self::USER_SESSION__NAME);
    }
}