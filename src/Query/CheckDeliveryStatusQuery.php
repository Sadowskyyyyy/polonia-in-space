<?php

declare(strict_types=1);

namespace App\Query;

use App\Shared\Application\Query\QueryInterface;

class CheckDeliveryStatusQuery implements QueryInterface
{
    public int $id;
    public string $destination;

    public function __construct(int $id, string $destination)
    {
        $this->id = $id;
        $this->destination = $destination;
    }
}
