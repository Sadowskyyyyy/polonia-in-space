<?php

namespace App\Repository;

use App\Entity\SpaceScientist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SpaceScientist|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpaceScientist|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpaceScientist[]    findAll()
 * @method SpaceScientist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpaceScientistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpaceScientist::class);
    }

    // /**
    //  * @return SpaceScientist[] Returns an array of SpaceScientist objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SpaceScientist
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
