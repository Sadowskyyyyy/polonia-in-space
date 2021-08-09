<?php

declare(strict_types=1);

namespace App\Application\Scientist\Domain;

use App\Application\Scientist\Application\Command\MarkMarsScientistAsMissingOrDeadCommand;
use function _HumbugBox243b3a4ed02c\RingCentral\Psr7\str;

class MissingOrDeadCommandValidator
{
    public function isValid(MarkMarsScientistAsMissingOrDeadCommand $command): void
    {
        if ($command->isDead === true && $command->isMissing === true ||
            $command->isDead === false && $command->isMissing === false) {
//            TODO some error
        }
        if (strlen($command->reason) > 255 || strlen($command->reason) < 32)
        {
//            TODO some error
        }
    }
}