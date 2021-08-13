<?php

declare(strict_types=1);

namespace App\Shared\Domain\Event;

abstract class Event
{
    public string $destination;
    public string $creationDate;

    public function __construct(string $destination)
    {
        $this->destination = $destination;
        $this->creationDate = date('Y-m-d H:i:s');
    }

    public function getDestination(): string
    {
        return $this->destination;
    }
}