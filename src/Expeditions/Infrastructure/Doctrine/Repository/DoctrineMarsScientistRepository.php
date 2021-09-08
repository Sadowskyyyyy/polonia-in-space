<?php
declare(strict_types=1);

namespace App\Expeditions\Infrastructure\Doctrine\Repository;

use App\Expeditions\Domain\Entity\MarsScientist;
use App\Expeditions\Domain\MarsScientistRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class DoctrineMarsScientistRepository extends ServiceEntityRepository implements MarsScientistRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MarsScientist::class);
    }

    public function existsCheckByApikey(string $apikey): bool
    {
        return null !== $this->findByApikey($apikey);
    }

    public function findByApikey(string $apikey): MarsScientist
    {
        return $this->findOneBy(['apikey' => $apikey]);
    }
}
