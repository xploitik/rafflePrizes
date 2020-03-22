<?php

namespace RafflePrizes\services\userService;

use RafflePrizes\interfaces\services\userService\model\UserInterface;
use RafflePrizes\interfaces\services\userService\UserRepositoryInterface;
use RafflePrizes\interfaces\services\userService\UserServiceInterface;
use RafflePrizes\services\userService\exceptions\UserServiceAddException;
use RafflePrizes\utils\ErrorMap;
use RafflePrizes\utils\SecurityHelper;

class UserService implements UserServiceInterface
{
    /** @var UserRepositoryInterface */
    protected $userRepository;

    /**
     * UserService constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param int $id
     * @return null|UserInterface
     */
    public function getById(int $id): ?UserInterface
    {
        return $this->userRepository->findById($id);
    }

    /**
     * @param string $email
     * @return null|UserInterface
     */
    public function getByEmail(string $email): ?UserInterface
    {
        return $this->userRepository->find(['conditions' => 'email = ?1', 'bind' => [1 => $email]]);
    }

    /**
     * @param array $data
     * @return bool
     * TODO: переделать передачу параметров в DTO
     */
    public function add(array $data): bool
    {
        if (!$this->validateAddData($data)) {
            return false;
        }

        $data['password'] = SecurityHelper::toHash($data['password']);

        $user = $this->userRepository->createModel($data);
        return $this->userRepository->save($user);
    }

    /**
     * @param array $data
     * @return bool
     * @throws UserServiceAddException
     */
    protected function validateAddData(array $data): bool
    {
        if (empty($data['name'])) {
            throw new UserServiceAddException(ErrorMap::USER_SERVICE_EMPTY_NAME);
        }

        if (empty($data['email'])) {
            throw new UserServiceAddException(ErrorMap::USER_SERVICE_EMPTY_EMAIL);
        }

        if (empty($data['password'])) {
            throw new UserServiceAddException(ErrorMap::USER_SERVICE_EMPTY_PASSWORD);
        }

        $user = $this->getByEmail($data['email']);
        if (!empty($user)) {
            throw new UserServiceAddException(ErrorMap::USER_SERVICE_EXIST_EMAIL);
        }

        return true;
    }
}