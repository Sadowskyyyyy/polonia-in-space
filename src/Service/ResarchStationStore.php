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
        $entity = null;
        $response = null;

        switch ($name) {
            case self::MARS_SCIENTIST:
                /** @var MarsResearchStation $entity */
                $entity = $this->entityManager->getRepository(MarsResearchStation::class)->find(1);
                $response = MarsResearchStation::toDomain($entity);
                break;
            case self::SPACE_SCIENTIST:
                /** @var SpaceResearchStation $entity */
                $entity = $this->entityManager->getRepository(SpaceResearchStation::class)->find(1);
                $response = SpaceResearchStation::toDomain($entity);
                break;
            case self::EARTH_SCIENTIST:
                /** @var EarthResearchStation $entity */
                $entity = $this->entityManager->getRepository(EarthResearchStation::class)->find(1);
                $response = EarthResearchStation::toDomain($entity);
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

    public function getResarchStationEntityByName(string $name): mixed
    {
        $entity = null;

        switch ($name) {
            case self::MARS_SCIENTIST:
                /** @var MarsResearchStation $entity */
                $entity = $this->entityManager->getRepository(MarsResearchStation::class)->find(1);
                break;
            case self::SPACE_SCIENTIST:
                /** @var SpaceResearchStation $entity */
                $entity = $this->entityManager->getRepository(SpaceResearchStation::class)->find(1);
                break;
            case self::EARTH_SCIENTIST:
                /** @var EarthResearchStation $entity */
                $entity = $this->entityManager->getRepository(EarthResearchStation::class)->find(1);
                break;
        }

        if (true === empty($entity)) {
            throw new NotFoundException();
        }

        return $entity;
    }
}
