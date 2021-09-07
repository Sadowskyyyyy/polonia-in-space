<?php
declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Repository;

use App\DomainModel\Repository\ExpeditionRepository;
use App\Entity\Expedition;
use App\Shared\Domain\Exception\NotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class DoctrineExpeditionRepository extends ServiceEntityRepository implements ExpeditionRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Expedition::class);
    }

    public function findById(int $id): Expedition
    {
        $expedition = $this->find($id);

        if (empty($expedition) === true){
            throw new NotFoundException();
        }

        return $expedition;
    }

    public function delete($expedition): void
    {
        $this->getEntityManager()->remove($expedition);
    }
}
