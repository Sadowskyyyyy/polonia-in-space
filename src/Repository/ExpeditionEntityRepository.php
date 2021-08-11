<?php

namespace App\Repository;

use App\Entity\ExpeditionEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ExpeditionEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExpeditionEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExpeditionEntity[]    findAll()
 * @method ExpeditionEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExpeditionEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExpeditionEntity::class);
    }

    // /**
    //  * @return ExpeditionEntity[] Returns an array of ExpeditionEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ExpeditionEntity
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
