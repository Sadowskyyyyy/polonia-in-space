<?php

declare(strict_types=1);

namespace App\Application\Expedition\Application\Command;

use App\Application\Shared\Application\Command\CommandInterface;

class PlanNewExpeditionCommand implements CommandInterface
{
    public string $plannedStartDate;

    public function __construct(string $plannedStartDate)
    {
        $this->plannedStartDate = $plannedStartDate;
    }
}
