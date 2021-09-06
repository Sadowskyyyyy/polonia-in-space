<?php
declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Repository;

use App\DomainModel\Repository\DeliveryRepository;
use App\Entity\Delivery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class DoctrineDeliveryRepository extends ServiceEntityRepository implements DeliveryRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Delivery::class);
    }
}
