<?php

declare(strict_types=1);

namespace App\Application\Scientist\Application\Event;

use App\Application\Shared\Domain\Event\EventInterface;

class MarsScientistCreated implements EventInterface
{
    public string $destination;
    public string $creationDate;

    public function __construct()
    {
        $this->destination = 'marsstation';
        $this->creationDate = date("Y-m-d H:i:s");
    }
}