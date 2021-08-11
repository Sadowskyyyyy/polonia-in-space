<?php

declare(strict_types=1);

namespace App\Application\ResarchStation\Application\Event;

use App\Application\Shared\Domain\Event\EventInterface;

class ChangedAngle implements EventInterface
{
    public string $destination;
    public string $creationDate;

    public function __construct()
    {
        $this->destination = 'earthstation';
        $this->creationDate = date("Y-m-d H:i:s");
    }
}