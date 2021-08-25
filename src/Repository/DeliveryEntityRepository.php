<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\DeliveryEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DeliveryEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method DeliveryEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method DeliveryEntity[]    findAll()
 * @method DeliveryEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeliveryEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DeliveryEntity::class);
    }

    public function findOneBySomeField($value): ?DeliveryEntity
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
