<?php
declare(strict_types=1);

namespace App\Users\Infrastructure\Doctrine;

use App\Expeditions\Domain\Entity\User;
use App\Shared\Domain\Exception\NotFoundException;
use App\Users\Domain\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final class DoctrineUserRepository implements UserRepository, UserProviderInterface
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

    public function findById(int $id): User
    {
        $user = $this->repository->find($id);

        if (true === empty($user)) {
            throw new NotFoundException();
        }

        return $user;
    }

    public function loadUserByUsername($username)
    {
        $this->findOneByApikey($username);
    }

    public function refreshUser(UserInterface $user)
    {
        return $this->loadUserByUsername($user->getPassword());
    }

    public function supportsClass($class): bool
    {
        return $class === User::class;
    }
}
