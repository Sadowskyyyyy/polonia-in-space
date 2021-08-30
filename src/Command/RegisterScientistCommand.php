<?php
declare(strict_types=1);

namespace App\Command;

use App\Shared\Application\Command;

class RegisterScientistCommand implements Command
{
    public string $name;
    public string $surname;
    public string $station;

    public function __construct(string $name, string $surname, string $station)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->station = $station;
    }
}
