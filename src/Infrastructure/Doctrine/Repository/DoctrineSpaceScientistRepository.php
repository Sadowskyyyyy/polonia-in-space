<?php
declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Repository;

use App\DomainModel\Repository\SpaceScientistRepository;
use App\Entity\SpaceScientist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class DoctrineSpaceScientistRepository extends ServiceEntityRepository implements SpaceScientistRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpaceScientist::class);
    }

    public function existsCheckByApikey(string $apikey): bool
    {
        return !empty($this->findByApikey($apikey)) === true;
    }

    public function findByApikey(string $apikey): SpaceScientist
    {
        return $this->findOneBy(['apikey' => $apikey]);
    }
}
