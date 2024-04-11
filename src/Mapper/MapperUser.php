<?php

namespace DevFullStack\Mapper;

use DevFullStack\Entity\User;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;

class MapperUser extends MapperObject
{
    /**
     * @return User[]
     */
    public function findAll(): array
    {
        $usersRepository = self::$entityManager->getRepository(User::class);

        /** @var User[] $usersList */
        return $usersRepository->findAll();
    }

    /**
     * @param $id
     * @return User|null
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function find($id): ?User
    {
        return self::$entityManager->find(User::class, $id);
    }

    public function findByEmail($email): ?User
    {
        $usersRepository = self::$entityManager->getRepository(User::class);

        return $usersRepository->findOneBy(['email' => $email]);
    }

    /**
     * @param User $user
     * @return User
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(User $user): User
    {
        self::$entityManager->persist($user);
        self::$entityManager->flush();

        return $user;
    }

    /**
     * @param User $user
     * @return User
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(User $user): User
    {
        self::$entityManager->flush();

        return $user;
    }

    public function delete(User $user): bool
    {
        self::$entityManager->remove($user);
        self::$entityManager->flush();
        return true;
    }
}