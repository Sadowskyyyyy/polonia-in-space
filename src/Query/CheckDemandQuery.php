<?php
declare(strict_types=1);

namespace App\Query;

use App\Shared\Application\Query\QueryInterface;

class CheckDemandQuery implements QueryInterface
{
    public string $direction;

    public function __construct(string $direction)
    {
        $this->direction = $direction;
    }
}
