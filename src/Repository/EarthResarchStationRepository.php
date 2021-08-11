<?php

namespace App\Repository;

use App\Entity\EarthResarchStation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EarthResarchStation|null find($id, $lockMode = null, $lockVersion = null)
 * @method EarthResarchStation|null findOneBy(array $criteria, array $orderBy = null)
 * @method EarthResarchStation[]    findAll()
 * @method EarthResarchStation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EarthResarchStationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EarthResarchStation::class);
    }

    // /**
    //  * @return EarthResarchStation[] Returns an array of EarthResarchStation objects
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
    public function findOneBySomeField($value): ?EarthResarchStation
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
