<?php

namespace Tribe\Service;

use Tribe\Entity\User;
use Tribe\Repository\UserRepository;

class UserService
{
    private UserRepository $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function findById(int $userId): ?User
    {
        return $this->userRepo->findById($userId);
    }

    /**
     * @return User[]
     */
    public function findAll(): array
    {
        return $this->userRepo->findAll();
    }

    public function save(array $params): User
    {
        $user = new User();
        $user->setEmail($params['email']);
        $user->setFirstName($params['firstName']);
        $user->setLastName($params['lastName']);
        $user->setRoles($params['roles']);

        $this->userRepo->insert($user);

        return $user;
    }

    public function update(int $userId, array $params): ?User
    {
        $user = $this->userRepo->findById($userId);
        if (!$user) {
            return null;
        }

        $user->setEmail($params['email']);
        $user->setFirstName($params['firstName']);
        $user->setLastName($params['lastName']);
        $user->setRoles($params['roles']);

        $this->userRepo->update($user);

        return $user;
    }
}