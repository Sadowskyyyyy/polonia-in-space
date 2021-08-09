<?php

declare(strict_types=1);

namespace App\Application\Scientist\Domain\Validation;

use App\Application\Scientist\Application\Command\MarkMarsScientistAsMissingOrDeadCommand;
use App\Application\Scientist\Domain\Exception\InvalidReasonException;
use App\Application\Shared\Domain\Exception\InvalidArgumentException;

//TODO make tests
class MissingOrDeadCommandValidator
{
    public function isValid(MarkMarsScientistAsMissingOrDeadCommand $command): void
    {
        if ($command->isDead === true && $command->isMissing === true ||
            $command->isDead === false && $command->isMissing === false) {
            throw new InvalidArgumentException();
        }
        if (strlen($command->reason) > 255 || strlen($command->reason) < 32) {
            throw new InvalidReasonException();
        }
    }
}