<?php

declare(strict_types=1);

namespace App\Application\Expedition\Application\Query;

use App\Application\Shared\Application\Query\QueryInterface;

class GenerateExpeditionConclusionQuery implements QueryInterface
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}