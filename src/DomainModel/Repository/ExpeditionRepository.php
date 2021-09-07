<?php
declare(strict_types=1);

namespace App\DomainModel\Repository;

use App\Entity\Expedition;

interface ExpeditionRepository
{
    public function findById(int $id): Expedition;
    public function delete(Expedition $expedition): void;
    public function save(Expedition $expedition): void;
}
