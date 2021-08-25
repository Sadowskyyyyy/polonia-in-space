<?php

namespace App\Repository;

use App\Entity\MarsScientistEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MarsScientistEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method MarsScientistEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method MarsScientistEntity[]    findAll()
 * @method MarsScientistEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarsScientistEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MarsScientistEntity::class);
    }
}
