<?php
declare(strict_types=1);

namespace App\Service;

use App\DomainModel\Expedition;
use App\Entity\ExpeditionEntity;
use App\Shared\Domain\Exception\NotFoundException;
use Doctrine\ORM\EntityManagerInterface;

final class ExpeditionStore implements ExpeditionRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(Expedition $expedition): void
    {
        $this->entityManager->persist($expedition);
        $this->entityManager->flush();
    }

    public function getById(int $id): Expedition
    {
        $entity = $this->entityManager->getRepository(ExpeditionEntity::class)->find($id);

        if (true === empty($entity)) {
            throw new NotFoundException();
        }

        return ExpeditionEntity::toDomain($entity);
    }
}
