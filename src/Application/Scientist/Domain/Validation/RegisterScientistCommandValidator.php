<?php

declare(strict_types=1);

namespace App\Application\Scientist\Domain\Validation;

use App\Application\Scientist\Application\Command\RegisterScientistCommand;
use App\Application\Shared\Domain\Exception\InvalidArgumentException;
use function strlen;

//TODO tests
class RegisterScientistCommandValidator
{
    public function __construct()
    {
    }

    public function isValid(RegisterScientistCommand $command): void
    {
        if (strlen($command->name) < 4 || strlen($command->name) > 25) {
            throw new InvalidArgumentException();
        }
        if (strlen($command->surname) < 6 || strlen($command->surname) > 32) {
            throw new InvalidArgumentException();
        }
    }
}
