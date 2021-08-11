<?php

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

    // /**
    //  * @return MarsResearchStationEntity[] Returns an array of MarsResearchStationEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MarsResearchStationEntity
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
