<?php
declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Repository;

use App\DomainModel\Repository\MarsResearchStationRepository;
use App\Entity\MarsResearchStation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class DoctrineMarsResearchStationRepository extends ServiceEntityRepository implements MarsResearchStationRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MarsResearchStation::class);
    }
}
