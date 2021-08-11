<?php

declare(strict_types=1);

namespace App\Application\Shared\Infrastructure\Repository;

use App\Application\Shared\Domain\Event\Event;
use App\Application\Shared\Domain\Event\EventRepositoryInterface;

class EventStore implements EventRepositoryInterface
{

    public function getAllEventsFrom(string $destination): array
    {
        return [];
    }

    public function save(Event $event): void
    {

    }
}