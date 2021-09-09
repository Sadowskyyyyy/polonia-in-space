<?php
declare(strict_types=1);

namespace App\Expeditions\Application\Command;

use App\Shared\Application\Command;

class DeleteExpeditionCommand implements Command
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}
