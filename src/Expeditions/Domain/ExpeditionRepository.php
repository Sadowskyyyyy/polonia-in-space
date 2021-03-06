<?php
declare(strict_types=1);

namespace App\Expeditions\Domain;

use App\Expeditions\Domain\Entity\Expedition;

interface ExpeditionRepository
{
    public function findById(int $id): Expedition;
    public function delete(Expedition $expedition): void;
    public function save(Expedition $expedition): void;
    public function findAll(): array;
    public function findByName(string $name): Expedition;
}
