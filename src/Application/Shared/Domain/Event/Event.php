<?php

declare(strict_types=1);

namespace App\Application\Shared\Domain\Event;

abstract class Event
{
    public string $destination;

    public function __construct(string $destination)
    {
        $this->destination = $destination;
    }
    public function getDestination(): string
    {
        return $this->destination;
    }
}
