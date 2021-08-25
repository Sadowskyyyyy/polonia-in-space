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
}
