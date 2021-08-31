<?php

declare(strict_types=1);

namespace App\Command;

use App\Shared\Application\Command;

class ChangeAngleCommand implements Command
{
    public float $degrees;

    public function __construct(float $degrees)
    {
        $this->degrees = $degrees;
    }
}
