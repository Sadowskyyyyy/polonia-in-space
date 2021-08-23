<?php
declare(strict_types=1);

namespace App\Service;

use App\DomainModel\Expedition;

interface ExpeditionRepositoryInterface
{
    public function getById(int $id): Expedition;
    public function save(Expedition $expedition): void;
}
