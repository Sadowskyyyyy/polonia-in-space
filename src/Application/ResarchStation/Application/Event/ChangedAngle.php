<?php

declare(strict_types=1);

namespace App\Application\ResarchStation\Application\Event;

use App\Application\Shared\Domain\Event\Event;

class ChangedAngle extends Event
{
    public string $destination;
    public string $creationDate;

    public function __construct()
    {
        parent::__construct('earthstation');
        $this->creationDate = date("Y-m-d H:i:s");
    }
}