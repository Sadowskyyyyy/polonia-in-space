<?php

namespace App\Repository;

use App\Entity\SpaceResearchStationEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SpaceResearchStationEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpaceResearchStationEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpaceResearchStationEntity[]    findAll()
 * @method SpaceResearchStationEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpaceResearchStationEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpaceResearchStationEntity::class);
    }
}
