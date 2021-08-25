<?php
declare(strict_types=1);

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
}
