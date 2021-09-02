<?php
declare(strict_types=1);

namespace App\Shared\Infrastructure\Repository;

use App\Entity\EarthResearchStation;
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
                $events = $station->getEvents()->toArray();
                break;
            case 'earthstation':
                /** @var EarthResearchStation $station */
                $station = $this->entityManager->getRepository(EarthResearchStation::class)->findOneBy(['id' => 1]);
                $events = $station->getEvents()->toArray();
                break;
            case 'spacestation':
                /** @var SpaceResearchStation $station */
                $station = $this->entityManager->getRepository(SpaceResearchStation::class)->findOneBy(['id' => 1]);
                $events = $station->getEvents()->toArray();
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
