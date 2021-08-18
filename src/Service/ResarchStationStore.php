<?php
declare(strict_types=1);

namespace App\Service;


use App\DomainModel\AbstractResearchStation;
use App\Entity\EarthScientistEntity;
use App\Entity\MarsResearchStationEntity;
use App\Entity\SpaceResearchStationEntity;
use App\Shared\Domain\Exception\NotFoundException;
use Doctrine\ORM\EntityManagerInterface;

class ResarchStationStore implements ResarchStationRepositoryInterface
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
            case 'marsstation':
                /**@var MarsResearchStationEntity $entity */
                $entity = $this->entityManager->getRepository(MarsResearchStationEntity::class)->find(1);
                $response = MarsResearchStationEntity::toDomain($entity);
                break;
            case 'spacestation':
                /**@var SpaceResearchStationEntity $entity */
                $entity = $this->entityManager->getRepository(SpaceResearchStationEntity::class)->find(1);
                $response = SpaceResearchStationEntity::toDomain($entity);
                break;
            case 'earthstation':
                /**@var EarthScientistEntity $entity */
                $entity = $this->entityManager->getRepository(EarthScientistEntity::class)->find(1);
                $response = EarthScientistEntity::toDomain($entity);
                break;
        }

        if (empty($entity) === true) {
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
