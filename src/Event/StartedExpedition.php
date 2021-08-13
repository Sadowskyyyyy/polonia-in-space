<?php

declare(strict_types=1);

namespace App\Event;

use App\Shared\Domain\Event\Event;

class StartedExpedition extends Event
{
    public function __construct()
    {
        parent::__construct('marsstation');
    }
}