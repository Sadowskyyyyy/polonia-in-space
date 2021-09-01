<?php
declare(strict_types=1);

namespace App\Query;

use App\Shared\Application\Query;

class GenerateExpeditionConclusionQuery implements Query
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}
