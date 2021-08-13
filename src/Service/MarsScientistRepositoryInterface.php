<?php
declare(strict_types=1);

namespace App\Service;

use App\DomainModel\MarsScientist;

interface MarsScientistRepositoryInterface
{
    public function getById(int $id): MarsScientist;
    public function save(MarsScientist $marsScientist): void;
    public function getAll(): array;
}
