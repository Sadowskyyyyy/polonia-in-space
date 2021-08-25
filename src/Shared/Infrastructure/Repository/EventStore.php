<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Repository;

use App\Entity\MarsResearchStation;
use App\Entity\SpaceResearchStation;
use App\Shared\Domain\Event\Event;
use App\Shared\Domain\Event\EventRepository;
use Doctrine\ORM\EntityManagerInterface;

class EventStore implements EventRepository
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
                /** @var MarsResearchStation $station */
                $station = $this->entityManager->getRepository(MarsResearchStation::class)->findOneBy(['id' => 1]);
                $events = $station->getEvents();
//            case 'earthstation':
//                /**@var EarthResearchStationEntity $station */
//                $station = $this->entityManager->getRepository(EarthResearchStationEntity::class)->findOneBy(['id' => 1]);
//                $events = $station->getEvents();
// no break
            case 'spacestation':
                /** @var SpaceResearchStation $station */
                $station = $this->entityManager->getRepository(SpaceResearchStation::class)->findOneBy(['id' => 1]);
                $events = $station->getEvents();
        }

        return $events;
    }

    public function save(Event $event): void
    {
        $this->entityManager->persist($event);
        $this->entityManager->flush();
    }
}
