<?php

/**
 * User service
 */

namespace App\Service;

use App\Entity\Category;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

/**
 * Class UserService
 * @package App\Service
 */
class UserService
{
    /**
     * User Repository
     *
     * @var UserRepository
     */
    private $userRepository;
/**
     * UserService constructor
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Save password
     *
     * @param Category
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(User $user): void
    {
        $this->userRepository->save($user);
    }

    /**
     * Find user by ID.
     *
     * @param int $id
     *
     * @return User|null
     */
    public function findOneById(int $id): ?User
    {
        return $this->userRepository->findOneById($id);
    }
}
