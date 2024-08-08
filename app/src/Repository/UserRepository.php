<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, User::class);
        $this->entityManager = $entityManager;
    }
    /**
     * Find a user by their data.
     */
    public function findByData(string $data): ?User
    {
        return $this->findOneBy(['data' => $data]);
    }

    /**
     * Custom method example: Find users by a partial data match.
     */
    public function findUsersByPartialData(string $partialData): array
    {
        return $this->createQueryBuilder('u')
            ->where('u.data LIKE :partialData')
            ->setParameter('partialData', '%'.$partialData.'%')
            ->getQuery()
            ->getResult();
    }

    public function save(User $user, bool $flush = true): void
    {
        $this->entityManager->persist($user);

        if ($flush) {
            $this->entityManager->flush();
        }
    }

    public function delete(User $user, bool $flush = true): void
    {
        $this->entityManager->remove($user);
        if ($flush) {
            $this->entityManager->flush();
        }
    }
}
