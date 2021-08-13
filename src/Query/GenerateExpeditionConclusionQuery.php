<?php
declare(strict_types=1);

namespace App\Query;

use App\Shared\Application\Query\QueryInterface;

class GenerateExpeditionConclusionQuery implements QueryInterface
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}
