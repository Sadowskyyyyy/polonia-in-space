<?php

declare(strict_types=1);

namespace App\Application\Scientist\Application\Event;

use App\Application\Shared\Domain\Event\Event;

class MarsScientistHasBeenMarkedAsDeadOrMissing extends Event
{
    public string $creationDate;

    public function __construct()
    {
        parent::__construct('marsstation');
        $this->creationDate = date('Y-m-d H:i:s');
    }
}
