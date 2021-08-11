<?php

declare(strict_types=1);

namespace App\Application\Shared\Domain\Event;

interface EventRepositoryInterface
{
    public function getAllEventsFrom(string $destination): array;

    public function save(Event $event): void;
}