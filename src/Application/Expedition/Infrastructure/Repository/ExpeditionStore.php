<?php

declare(strict_types=1);

namespace App\Application\Expedition\Infrastructure\Repository;

use App\Application\Expedition\Domain\Expedition;
use App\Application\Expedition\Domain\Repository\ExpeditionRepositoryInterface;

class ExpeditionStore implements ExpeditionRepositoryInterface
{
    public function save(Expedition $expedition): void
    {
        // TODO: Implement save() method.
    }

    public function getById(int $id): Expedition
    {
        // TODO: Implement getById() method.
    }
}
