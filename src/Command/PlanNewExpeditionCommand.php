<?php
declare(strict_types=1);

namespace App\Command;

use App\Shared\Application\Command;

class PlanNewExpeditionCommand implements Command
{
    public string $plannedStartDate;

    public function __construct(string $plannedStartDate)
    {
        $this->plannedStartDate = $plannedStartDate;
    }
}
