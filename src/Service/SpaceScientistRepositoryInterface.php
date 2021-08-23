<?php
declare(strict_types=1);

namespace App\Service;

use App\DomainModel\SpaceScientist;

interface SpaceScientistRepositoryInterface
{
    public function getById(int $id): SpaceScientist;
    public function save(SpaceScientist $scientist): void;
}
