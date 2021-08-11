<?php

namespace App\Application\ResarchStation\Application\Event;

use App\Application\Shared\Domain\Event\EventInterface;

class ReportedARequest implements EventInterface
{
    public string $destination;

    public function __construct(string $destination)
    {
        $this->destination = $destination;
    }
}