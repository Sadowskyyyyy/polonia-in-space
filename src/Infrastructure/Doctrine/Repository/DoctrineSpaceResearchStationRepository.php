<?php
declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Repository;

use App\DomainModel\Repository\SpaceResearchStationRepository;
use App\Entity\SpaceResearchStation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class DoctrineSpaceResearchStationRepository extends ServiceEntityRepository implements SpaceResearchStationRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpaceResearchStation::class);
    }
}
