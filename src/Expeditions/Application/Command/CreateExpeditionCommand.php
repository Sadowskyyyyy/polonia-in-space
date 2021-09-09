<?php
declare(strict_types=1);

namespace App\Expeditions\Application\Command;

use App\Shared\Application\Command;

class CreateExpeditionCommand implements Command
{
    public string $name;
    public string $plannedStartDate;

    public function __construct(string $name, string $plannedStartDate)
    {
        $this->name = $name;
        $this->plannedStartDate = $plannedStartDate;
    }
}
