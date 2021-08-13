<?php

declare(strict_types=1);

namespace App\Service;

use App\Application\Scientist\Domain\SpaceScientist\SpaceScientist;

interface SpaceScientistRepositoryInterface
{
    public function getById(int $id): SpaceScientist;

    public function save(SpaceScientist $scientist): void;
}