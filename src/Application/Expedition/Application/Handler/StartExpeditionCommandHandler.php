<?php

declare(strict_types=1);

namespace App\Application\Expedition\Application\Handler;

use App\Application\Expedition\Application\Command\StartExpeditionCommand;

class StartExpeditionCommandHandler implements MessageSubscriberInterface
{
    public function __invoke(StartExpeditionCommand $command)
    {
        //TODO get expedition and start
        $expedition->startExpedition();
        //TODO save and save event
    }
}