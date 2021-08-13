<?php

declare(strict_types=1);

namespace App\Command;

use App\Shared\Application\Command\CommandInterface;
class ReportARequestCommand implements CommandInterface
{
    public string $destination;

    public function __construct(string $destination)
    {
        $this->destination = $destination;
    }
}