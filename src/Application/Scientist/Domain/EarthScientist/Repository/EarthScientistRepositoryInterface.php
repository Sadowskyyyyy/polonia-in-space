<?php

declare(strict_types=1);

namespace App\Application\Scientist\Domain\EarthScientist\Repository;

interface EarthScientistRepositoryInterface
{
    public function getById(int $id): EarthScientist;

    public function save(EarthScientist $marsScientist): void;
}
