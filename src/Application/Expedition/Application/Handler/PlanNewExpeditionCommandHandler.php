<?php

declare(strict_types=1);

namespace App\Application\Expedition\Application\Handler;

use App\Application\Expedition\Application\Command\PlanNewExpeditionCommand;
use App\Application\Expedition\Domain\Expedition;

class PlanNewExpeditionCommandHandler implements MessageSubscriberInterface
{
    public function __invoke(PlanNewExpeditionCommand $command)
    {
        $expedition = Expedition::planNewExpedition(null, $command->plannedStartDate);
        //TODO save to the database and event save to db
    }
}