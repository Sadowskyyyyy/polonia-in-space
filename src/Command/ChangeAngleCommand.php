<?php

declare(strict_types=1);

namespace App\Command;

use App\Shared\Application\Command\CommandInterface;

class ChangeAngleCommand implements CommandInterface
{
    public float $degrees;

    public function __construct(float $degrees)
    {
        $this->degrees = $degrees;
    }
}
