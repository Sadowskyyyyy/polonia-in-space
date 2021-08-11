<?php

declare(strict_types=1);

namespace App\Application\ResarchStation\Application\Command;

use App\Application\Shared\Application\Command\CommandInterface;

class ChangeAngleCommand implements CommandInterface
{
    private float $degrees;

    public function __construct(float $degrees)
    {
        $this->degrees = $degrees;
    }
}