<?php

declare(strict_types=1);

namespace App\Application\ResarchStation\Application\Command;

use App\Application\Shared\Application\Command\CommandInterface;

class ReportARequestCommand implements CommandInterface
{
    public string $destination;

    public function __construct(string $destination)
    {
        $this->destination = $destination;
    }
}