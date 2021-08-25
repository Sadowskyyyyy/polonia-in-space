<?php
declare(strict_types=1);

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
}
