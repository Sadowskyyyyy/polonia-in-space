<?php
declare(strict_types=1);

namespace App\Service;

use App\Command\MarkMarsScientistAsMissingOrDeadCommand;
use App\Exception\InvalidReasonException;
use App\Shared\Domain\Exception\InvalidArgumentException;

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
