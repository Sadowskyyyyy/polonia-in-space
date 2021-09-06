<?php
declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Repository;

use App\DomainModel\Repository\MarsScientistRepository;
use App\Entity\MarsScientistEntity;
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
        return true === !empty($this->findByApikey($apikey));
    }

    public function findByApikey(string $apikey): MarsScientistEntity
    {
        return $this->findOneBy(['apikey' => $apikey]);
    }
}
