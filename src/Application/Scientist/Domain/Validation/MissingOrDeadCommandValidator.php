<?php

declare(strict_types=1);

namespace App\Application\Scientist\Domain\Validation;

use App\Application\Scientist\Application\Command\MarkMarsScientistAsMissingOrDeadCommand;
use App\Application\Scientist\Domain\Exception\InvalidReasonException;
use App\Application\Shared\Domain\Exception\InvalidArgumentException;

class MissingOrDeadCommandValidator
{
    public function __construct()
    {
    }

    public function isValid(MarkMarsScientistAsMissingOrDeadCommand $command): void
    {
        if (true === $command->isDead && true === $command->isMissing ||
            false === $command->isDead && false === $command->isMissing) {
            throw new InvalidArgumentException();
        }
        if (strlen($command->reason) > 255 || strlen($command->reason) < 32) {
            throw new InvalidReasonException();
        }
    }
}
