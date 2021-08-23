<?php

declare(strict_types=1);

namespace App\Application\ResarchStation\Application\Query;

use App\Application\Shared\Application\Query\QueryInterface;

class CheckDemand implements QueryInterface
{
    public string $direction;

    public function __construct(string $direction)
    {
        $this->direction = $direction;
    }
}
