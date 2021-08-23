<?php

namespace App\Application\ResarchStation\Application\Event;

namespace App\Event;

use App\Shared\Domain\Event\Event;

class ReportedARequest extends Event
{
    public function __construct(string $destination)
    {
        parent::__construct($destination);
    }
}
