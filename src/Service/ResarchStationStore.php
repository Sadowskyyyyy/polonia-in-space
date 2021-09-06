<?php
declare(strict_types=1);

namespace App\Service;

use App\DomainModel\AbstractResearchStation;
use App\Entity\EarthResearchStation;
use App\Entity\MarsResearchStation;
use App\Entity\SpaceResearchStation;
use App\Shared\Domain\Exception\NotFoundException;
use Doctrine\ORM\EntityManagerInterface;

class ResarchStationStore implements ResarchStationRepositoryInterface
{
    public const EARTH_SCIENTIST = 'earthstation';
    public const SPACE_SCIENTIST = 'spacestation';
    public const MARS_SCIENTIST = 'marsstation';

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getResarchStationByName(string $name): AbstractResearchStation
    {
        $response = match ($name) {
            self::EARTH_SCIENTIST => $this->getEarthResearchStationDomainModel(),
            self::SPACE_SCIENTIST => $this->getSpaceResearchStationDomainModel(),
            self::MARS_SCIENTIST => $this->getMarsResearchStationDomainModel(),
        };

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

    public function getResarchStationEntityByName(string $name): mixed
    {
        $entity = match ($name) {
            self::MARS_SCIENTIST => $this->entityManager->getRepository(MarsResearchStation::class)->find(1),
            self::SPACE_SCIENTIST => $this->entityManager->getRepository(SpaceResearchStation::class)->find(1),
            self::EARTH_SCIENTIST => $this->entityManager->getRepository(EarthResearchStation::class)->find(1),
            default => null,
        };

        if (true === empty($entity)) {
            throw new NotFoundException();
        }

        return $entity;
    }

    private function getMarsResearchStationDomainModel(): \App\DomainModel\MarsResearchStation
    {
        /** @var MarsResearchStation $entity */
        $entity = $this->entityManager->getRepository(MarsResearchStation::class)->find(1);

        return MarsResearchStation::toDomain($entity);
    }

    private function getEarthResearchStationDomainModel(): \App\DomainModel\EarthResearchStation
    {
        /** @var EarthResearchStation $entity */
        $entity = $this->entityManager->getRepository(EarthResearchStation::class)->find(1);

        return EarthResearchStation::toDomain($entity);
    }

    private function getSpaceResearchStationDomainModel(): \App\DomainModel\SpaceResearchStation
    {
        /** @var SpaceResearchStation $entity */
        $entity = $this->entityManager->getRepository(SpaceResearchStation::class)->find(1);

        return SpaceResearchStation::toDomain($entity);
    }
}
