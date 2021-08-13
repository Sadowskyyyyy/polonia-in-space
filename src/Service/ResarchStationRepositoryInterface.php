<?php

declare(strict_types=1);

namespace App\Service;

interface ResarchStationRepositoryInterface
{
    public function getResarchStationByName(string $name);
}