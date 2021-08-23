<?php

declare(strict_types=1);

namespace App\Application\Scientist\Domain\MarsScientist\Repository;

use App\Application\Scientist\Domain\MarsScientist\MarsScientist;

interface MarsScientistRepositoryInterface
{
    public function getById(int $id): MarsScientist;

    public function save(MarsScientist $marsScientist): void;

    public function getAll(): array;
}
