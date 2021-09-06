<?php
declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Repository;

use App\DomainModel\Repository\EarthScientistRepository;
use App\Entity\EarthScientist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class DoctrineEarthScientistRepository extends ServiceEntityRepository implements EarthScientistRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EarthScientist::class);
    }

    public function existsCheckByApikey(string $apikey): bool
    {
        return true === !empty($this->findByApikey($apikey));
    }

    public function findByApikey(string $apikey): EarthScientist
    {
        return $this->findOneBy(['apikey' => $apikey]);
    }
}
