<?php

namespace App\Application\ResarchStation\Application\Event;

use App\Application\Shared\Domain\Event\Event;

class ReportedARequest extends Event
{
    public string $destination;

    public function __construct(string $destination)
    {
        parent::__construct($destination);
    }
}
