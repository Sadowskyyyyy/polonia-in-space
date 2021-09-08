<?php
declare(strict_types=1);

namespace App\Users\Infrastructure\Doctrine;

use App\DomainModel\Repository\UserRepository;
use App\Entity\User;
use App\Shared\Domain\Exception\NotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

final class DoctrineUserRepository implements UserRepository
{
    private EntityRepository $repository;

    public function __construct(private EntityManagerInterface $entityManager)
    {
        $this->repository = $this->entityManager->getRepository(User::class);
    }

    public function findOneByApikey(string $apikey): User
    {
        return $this->repository->findOneBy(['apikey' => $apikey]);
    }

    public function save(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function findById(int $id)
    {
        $user = $this->repository->find($id);

        if (empty($user) === true) {
            throw new NotFoundException();
        }

        return $user;
    }
}
