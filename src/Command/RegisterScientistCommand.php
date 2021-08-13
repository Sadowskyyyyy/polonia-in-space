<?php

declare(strict_types=1);

namespace App\Command;


use App\Shared\Application\Command\CommandInterface;

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