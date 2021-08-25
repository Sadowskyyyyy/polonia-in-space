<?php
declare(strict_types=1);

namespace App\Shared\Infrastructure\Repository;

use App\Entity\EarthResarchStation;
use App\Entity\MarsResearchStationEntity;
use App\Entity\SpaceResearchStationEntity;
use App\Shared\Domain\Event\Event;
use App\Shared\Domain\Event\EventRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class EventStore implements EventRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAllEventsFrom(string $destination): array
    {
        $events = [];

        switch ($destination) {
            case 'marsstation':
                /** @var MarsResearchStationEntity $station */
                $station = $this->entityManager->getRepository(MarsResearchStationEntity::class)->findOneBy(['id' => 1]);
                $events = $station->getEvents();
                break;
            case 'earthstation':
                /** @var EarthResarchStation $station */
                $station = $this->entityManager->getRepository(EarthResarchStation::class)->findOneBy(['id' => 1]);
                $events = $station->getEvents();
                break;
            case 'spacestation':
                /** @var SpaceResearchStationEntity $station */
                $station = $this->entityManager->getRepository(SpaceResearchStationEntity::class)->findOneBy(['id' => 1]);
                $events = $station->getEvents();
                break;
        }

        return $events;
    }

    public function save(Event $event): void
    {
        $this->entityManager->persist($event);
        $this->entityManager->flush();
    }
}
