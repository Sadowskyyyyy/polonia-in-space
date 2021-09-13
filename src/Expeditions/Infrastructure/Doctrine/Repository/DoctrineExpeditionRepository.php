<?php
declare(strict_types=1);

namespace App\Expeditions\Infrastructure\Doctrine\Repository;

use App\Expeditions\Domain\Entity\Expedition;
use App\Expeditions\Domain\ExpeditionRepository;
use App\Shared\Domain\Exception\NotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

final class DoctrineExpeditionRepository implements ExpeditionRepository
{
    private EntityRepository $repository;

    public function __construct(private EntityManagerInterface $entityManager)
    {
        $this->repository = $this->entityManager->getRepository(Expedition::class);
    }

    public function findById(int $id): Expedition
    {
        $expedition = $this->repository->find($id);

        if (true === empty($expedition)) {
            throw new NotFoundException();
        }

        return $expedition;
    }

    public function delete(Expedition $expedition): void
    {
        $this->entityManager->remove($expedition);
        $this->entityManager->flush();
    }

    public function save(Expedition $expedition): void
    {
        $this->entityManager->persist($expedition);
        $this->entityManager->flush();
    }

    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function findByName(string $name): Expedition
    {
        return $this->repository->findOneBy(['name' => $name]);
    }
}
