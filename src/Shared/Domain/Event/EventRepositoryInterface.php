<?php
declare(strict_types=1);

namespace App\Shared\Domain\Event;

interface EventRepositoryInterface
{
    public function getAllEventsFrom(string $destination): array;
    public function save(Event $event): void;
}
