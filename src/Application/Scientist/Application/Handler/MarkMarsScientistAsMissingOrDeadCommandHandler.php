<?php

declare(strict_types=1);

namespace App\Application\Scientist\Application\Handler;

use App\Application\Scientist\Application\Command\MarkMarsScientistAsMissingOrDeadCommand;

class MarkMarsScientistAsMissingOrDeadCommandHandler implements MessageSubscriberInterface
{
    public function __invoke(MarkMarsScientistAsMissingOrDeadCommand $command)
    {
        //TODO get scientist
//        $scientist;
        if ($command->isMissing === true) {
            $scientist->markAsMissing();
            $scientist->setReasonOfDeath($command->reason);
        }
        if ($command->isDead === true) {
            $scientist->markAsDead();
            $scientist->setReasonOfDeath($command->reason);
        }

//        TODO save to database
    }
}