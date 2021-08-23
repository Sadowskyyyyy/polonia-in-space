<?php

declare(strict_types=1);

namespace App\Application\Scientist\Domain\SpaceScientist\Repository;

use App\Application\Scientist\Domain\SpaceScientist\SpaceScientist;

interface SpaceScientistRepositoryInterface
{
    public function getById(int $id): SpaceScientist;

    public function save(SpaceScientist $scientist): void;
}
