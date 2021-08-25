<?php
declare(strict_types=1);

namespace App\Service;

use App\DomainModel\AbstractResearchStation;

interface ResarchStationRepository
{
    public function getResarchStationByName(string $name): AbstractResearchStation;
    public function save(AbstractResearchStation $researchStation): void;
}
