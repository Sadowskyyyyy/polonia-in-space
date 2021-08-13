<?php
declare(strict_types=1);

namespace App\Service;

use App\DomainModel\EarthScientist;
use App\Entity\EarthScientistEntity;
use App\Shared\Domain\Exception\NotFoundException;
use Doctrine\ORM\EntityManagerInterface;

class EarthScientistStore implements EarthScientistRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getById(int $id): ?EarthScientist
    {
        $entity = $this->entityManager->getRepository(EarthScientistEntity::class)->find($id);

        if (empty($entity) === true) {
            throw new NotFoundException();
        }

        return EarthScientistEntity::toDomain($entity);
    }

    public function save(EarthScientist $earthScientist): void
    {
        $this->entityManager->persist(EarthScientist::toEntity($earthScientist));
        $this->entityManager->flush();
    }
}
