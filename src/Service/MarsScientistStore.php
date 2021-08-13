<?php

declare(strict_types=1);

namespace App\Service;

use App\Application\Scientist\Domain\MarsScientist\MarsScientist;
use App\Application\Scientist\Domain\MarsScientist\Repository\MarsScientistRepositoryInterface;
use App\Entity\MarsScientistEntity;
use Doctrine\ORM\EntityManagerInterface;

//TODO tests and implementation
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