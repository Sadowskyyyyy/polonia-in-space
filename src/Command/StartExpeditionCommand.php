<?php
declare(strict_types=1);

namespace App\Command;

use App\Shared\Application\Command;

class StartExpeditionCommand implements Command
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}
