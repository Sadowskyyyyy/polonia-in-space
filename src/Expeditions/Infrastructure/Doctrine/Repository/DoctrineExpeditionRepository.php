<?php
declare(strict_types=1);

namespace App\Expeditions\Infrastructure\Doctrine\Repository;

use App\DomainModel\Repository\ExpeditionRepository;
use App\Entity\Expedition;
use App\Shared\Domain\Exception\NotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

final class DoctrineExpeditionRepository extends ServiceEntityRepository implements ExpeditionRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Expedition::class);
        $this->entityManager = $entityManager;
    }

    public function findById(int $id): Expedition
    {
        $expedition = $this->find($id);

        if (true === empty($expedition)) {
            throw new NotFoundException();
        }

        return $expedition;
    }

    public function delete(Expedition $expedition): void
    {
        $this->entityManager->remove($expedition);
    }

    public function save(Expedition $expedition): void
    {
        $this->entityManager->persist($expedition);
        $this->entityManager->flush();
    }
}
