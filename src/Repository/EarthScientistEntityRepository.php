<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\EarthScientistEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EarthScientistEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method EarthScientistEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method EarthScientistEntity[]    findAll()
 * @method EarthScientistEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EarthScientistEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EarthScientistEntity::class);
    }

    // /**
    //  * @return EarthScientistEntity[] Returns an array of EarthScientistEntity objects
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
    public function findOneBySomeField($value): ?EarthScientistEntity
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
