<?php

declare(strict_types=1);

namespace App\Application\Expedition\Application\Command;

use App\Application\Shared\Application\Command\CommandInterface;

class FinishExpeditionCommand implements CommandInterface
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}