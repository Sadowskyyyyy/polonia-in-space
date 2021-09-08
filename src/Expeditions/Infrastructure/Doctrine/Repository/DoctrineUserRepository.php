<?php
declare(strict_types=1);

namespace App\Expeditions\Infrastructure\Doctrine\Repository;

use App\Expeditions\Domain\Entity\User;
use App\Expeditions\Domain\UserRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class DoctrineUserRepository extends ServiceEntityRepository implements UserRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findOneByApikey(string $apikey): User
    {
        $user = $this->findOneBy(['apikey' => $apikey]);

        if (null === $user) {
            throw new \Exception();
        }

        return $user;
    }
}
