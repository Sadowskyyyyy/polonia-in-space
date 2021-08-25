<?php

namespace App\Repository;

use App\Entity\EarthScientist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EarthScientist|null find($id, $lockMode = null, $lockVersion = null)
 * @method EarthScientist|null findOneBy(array $criteria, array $orderBy = null)
 * @method EarthScientist[]    findAll()
 * @method EarthScientist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EarthScientistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EarthScientist::class);
    }

    // /**
    //  * @return EarthScientist[] Returns an array of EarthScientist objects
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
    public function findOneBySomeField($value): ?EarthScientist
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
