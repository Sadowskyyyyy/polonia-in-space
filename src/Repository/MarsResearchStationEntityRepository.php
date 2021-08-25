<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\MarsResearchStationEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MarsResearchStationEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method MarsResearchStationEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method MarsResearchStationEntity[]    findAll()
 * @method MarsResearchStationEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarsResearchStationEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MarsResearchStationEntity::class);
    }
}
