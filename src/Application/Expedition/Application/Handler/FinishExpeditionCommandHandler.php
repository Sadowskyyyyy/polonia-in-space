<?php

declare(strict_types=1);

namespace App\Application\Expedition\Application\Handler;

use App\Application\Expedition\Application\Command\FinishExpeditionCommand;

class FinishExpeditionCommandHandler implements MessageSubscriberInterface
{
    public function __invoke(FinishExpeditionCommand $command)
    {
    //TODO get expedition from database and save event etc
        $expedition->finishExpedition();
    }
}