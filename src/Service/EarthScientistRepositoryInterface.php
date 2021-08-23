<?php
declare(strict_types=1);

namespace App\Service;

use App\DomainModel\EarthScientist;

interface EarthScientistRepositoryInterface
{
    public function getById(int $id): ?EarthScientist;
    public function save(EarthScientist $earthScientist): void;
}
