<?php
declare(strict_types=1);

namespace App\Service;

use App\DomainModel\AbstractResearchStation;
use App\Entity\SpaceResearchStation;
use App\Shared\Domain\Exception\NotFoundException;
use Doctrine\ORM\EntityManagerInterface;

class ResarchStationStore implements ResarchStationRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getResarchStationByName(string $name): AbstractResearchStation
    {
        $entity = null;
        $response = null;

        switch ($name) {
            case 'spacestation':
                /** @var SpaceResearchStation $entity */
                $entity = $this->entityManager->getRepository(SpaceResearchStation::class)->find(1);
                $response = SpaceResearchStation::toDomain($entity);
                break;
        }

        if (true === empty($entity)) {
            throw new NotFoundException();
        }

        return $response;
    }

    public function save(AbstractResearchStation $researchStation): void
    {
        $this->entityManager->persist($researchStation);
        $this->entityManager->flush();
    }
}
