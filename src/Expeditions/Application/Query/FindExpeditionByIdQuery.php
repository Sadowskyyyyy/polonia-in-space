<?php
declare(strict_types=1);

namespace App\Expeditions\Application\Query;

use App\Shared\Application\Query;

class FindExpeditionByIdQuery implements Query
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}
