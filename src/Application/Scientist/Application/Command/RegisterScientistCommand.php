<?php

declare(strict_types=1);

namespace App\Application\Scientist\Application\Command;

use App\Application\Shared\Application\Command\CommandInterface;

class RegisterScientistCommand implements CommandInterface
{
    public string $name;
    public string $surname;

    public function __construct(string $name, string $surname)
    {
        $this->name = $name;
        $this->surname = $surname;
    }
}
