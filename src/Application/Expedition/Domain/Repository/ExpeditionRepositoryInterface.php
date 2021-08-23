<?php

declare(strict_types=1);

namespace App\Application\Expedition\Domain\Repository;

use App\Application\Expedition\Domain\Expedition;

interface ExpeditionRepositoryInterface
{
    public function getById(int $id): Expedition;

    public function save(Expedition $expedition): void;
}
