<?php
declare(strict_types=1);

namespace App\Service;

use App\DomainModel\MarsScientist;
use App\Entity\MarsScientistEntity;
use App\Shared\Domain\Exception\NotFoundException;
use Doctrine\ORM\EntityManagerInterface;

final class MarsScientistStore implements MarsScientistRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getById(int $id): MarsScientist
    {
        $entity = $this->entityManager->getRepository(MarsScientistEntity::class)->findOneBy(['id' => $id]);

        if (empty($entity) === true) {
            throw new NotFoundException();
        }

        return MarsScientistEntity::toDomain($entity);
    }

    public function save(MarsScientist $marsScientist): void
    {
        $this->entityManager->persist(MarsScientist::toEntity($marsScientist));
        $this->entityManager->flush();
    }

    public function getAll(): array
    {
        $entities = $this->entityManager->getRepository(MarsScientistEntity::class)->findAll();
        $domainModels = [];
        foreach ($entities as $entity) {
            $domainModels[] = MarsScientistEntity::toDomain($entity);
        }

        return $domainModels;
    }
}
