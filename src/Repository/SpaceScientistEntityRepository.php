<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\SpaceScientistEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SpaceScientistEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpaceScientistEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpaceScientistEntity[]    findAll()
 * @method SpaceScientistEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpaceScientistEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpaceScientistEntity::class);
    }

    // /**
    //  * @return SpaceScientistEntity[] Returns an array of SpaceScientistEntity objects
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
    public function findOneBySomeField($value): ?SpaceScientistEntity
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
