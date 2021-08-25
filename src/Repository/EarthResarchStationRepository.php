<?php

namespace App\Repository;

use App\Entity\EarthResearchStation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EarthResearchStation|null find($id, $lockMode = null, $lockVersion = null)
 * @method EarthResearchStation|null findOneBy(array $criteria, array $orderBy = null)
 * @method EarthResearchStation[]    findAll()
 * @method EarthResearchStation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EarthResarchStationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EarthResearchStation::class);
    }
}
