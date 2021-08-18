<?php
declare(strict_types=1);

namespace App\Service;

use App\DomainModel\SpaceScientist;
use App\Entity\SpaceScientistEntity;
use App\Shared\Domain\Exception\NotFoundException;
use Doctrine\ORM\EntityManagerInterface;

final class SpaceScientistStore implements SpaceScientistRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getById(int $id): SpaceScientist
    {
        $entity = $this->entityManager->getRepository(SpaceScientistEntity::class)->find($id);

        if (empty($entity) === true) {
            throw new NotFoundException();
        }

        return SpaceScientistEntity::toDomain($entity);
    }

    public function save(SpaceScientist $scientist): void
    {
        $this->entityManager->persist($scientist);
        $this->entityManager->flush();
    }
}
