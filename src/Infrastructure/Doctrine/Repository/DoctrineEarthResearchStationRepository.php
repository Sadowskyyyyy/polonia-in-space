<?php
declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Repository;

use App\DomainModel\Repository\EarthResearchStationRepository;
use App\Entity\EarthResearchStation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class DoctrineEarthResearchStationRepository extends ServiceEntityRepository implements EarthResearchStationRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EarthResearchStation::class);
    }
}
