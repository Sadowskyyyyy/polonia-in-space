<?php

declare(strict_types=1);

namespace App\Command;

use App\Shared\Application\Command;

class ReportARequestCommand implements Command
{
    public string $destination;

    public function __construct(string $destination)
    {
        $this->destination = $destination;
    }
}
