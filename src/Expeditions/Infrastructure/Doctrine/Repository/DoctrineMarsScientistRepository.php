<?php
declare(strict_types=1);

namespace App\Expeditions\Infrastructure\Doctrine\Repository;

use App\Entity\MarsScientistEntity;
use App\Expeditions\Domain\MarsScientistRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class DoctrineMarsScientistRepository extends ServiceEntityRepository implements MarsScientistRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MarsScientistEntity::class);
    }

    public function existsCheckByApikey(string $apikey): bool
    {
        return $this->findByApikey($apikey) !== null;
    }

    public function findByApikey(string $apikey): MarsScientistEntity
    {
        return $this->findOneBy(['apikey' => $apikey]);
    }
}
