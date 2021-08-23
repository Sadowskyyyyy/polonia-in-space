<?php

namespace App\Application\Scientist\Infrastructure\MarsScientist\Repository;

use App\Application\Scientist\Domain\MarsScientist\MarsScientist;
use App\Application\Scientist\Domain\MarsScientist\Repository\MarsScientistRepositoryInterface;

//TODO tests and implementation
final class MarsScientistStore implements MarsScientistRepositoryInterface
{
    public function getById(int $id): MarsScientist
    {
    }

    public function save(MarsScientist $marsScientist): void
    {
    }

    public function getAll(): array
    {
        // TODO: Implement getAll() method.
    }
}
