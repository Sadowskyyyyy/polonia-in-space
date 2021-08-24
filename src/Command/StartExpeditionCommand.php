<?php
declare(strict_types=1);

namespace App\Command;

use App\Shared\Application\Command\CommandInterface;

class StartExpeditionCommand implements CommandInterface
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}
