<?php
declare(strict_types=1);

namespace App\Service;

//TODO tests
use App\Command\RegisterScientistCommand;
use App\Shared\Domain\Exception\InvalidArgumentException;

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
