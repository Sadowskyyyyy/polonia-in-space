<?php
declare(strict_types=1);

namespace App\Service;

use App\DomainModel\AbstractResearchStation;
use App\Entity\EarthResarchStation;
use App\Repository\MarsResearchStationEntityRepository;
use App\Repository\SpaceResearchStationEntityRepository;
use Doctrine\ORM\EntityManagerInterface;

class ResearchStationStore implements ResarchStationRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getResarchStationByName(string $name): AbstractResearchStation
    {
        $researchStation = null;

        switch ($name) {
            case 'marsstation':
                $researchStation = $this->entityManager
                    ->getRepository(MarsResearchStationEntityRepository::class)->find(1);
                break;
            case 'spacestation':
                $researchStation = $this->entityManager
                    ->getRepository(SpaceResearchStationEntityRepository::class)->find(1);
                break;
            case 'earthstation':
                $researchStation = $this->entityManager
                    ->getRepository(EarthResarchStation::class)->find(1);
                break;
        }

        return $researchStation;
    }

    public function save(AbstractResearchStation $researchStation)
    {

    }
}
