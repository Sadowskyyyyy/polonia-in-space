<?php

declare(strict_types=1);

namespace App\Event;

use App\Application\Shared\Domain\Event\Event;

class MarsScientistCreated extends Event
{
    public function __construct()
    {
        parent::__construct('marsstation');
    }
}