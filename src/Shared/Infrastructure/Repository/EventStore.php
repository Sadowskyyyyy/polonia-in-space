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
    public const MARS_STATION = 'marsstation';
    public const EARTH_STATION = 'earthstation';
    public const SPACE_STATION = 'spacestation';

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAllEventsFrom(string $destination): array
    {
        return match ($destination) {
            self::MARS_STATION => $this->getEventsFromMarsStation(),
            self::EARTH_STATION => $this->getEventsFromEarthStation(),
            self::SPACE_STATION => $this->getEventsFromSpaceStation(),
            default => throw new \Exception('Something went wrong')
        };
    }

    public function save(Event $event): void
    {
        $this->entityManager->persist($event);
        $this->entityManager->flush();
    }

    private function getEventsFromMarsStation(): array
    {
        /** @var MarsResearchStation $station */
        $station = $this->entityManager->getRepository(MarsResearchStation::class)->findOneBy(['id' => 1]);

        return $station->getEvents()->toArray();
    }

    private function getEventsFromEarthStation(): array
    {
        /** @var EarthResearchStation $station */
        $station = $this->entityManager->getRepository(EarthResearchStation::class)->findOneBy(['id' => 1]);

        return $station->getEvents()->toArray();
    }

    private function getEventsFromSpaceStation(): array
    {
        /** @var SpaceResearchStation $station */
        $station = $this->entityManager->getRepository(SpaceResearchStation::class)->findOneBy(['id' => 1]);

        return $station->getEvents()->toArray();
    }
}
