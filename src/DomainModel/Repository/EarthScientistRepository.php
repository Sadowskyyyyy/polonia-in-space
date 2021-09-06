<?php
declare(strict_types=1);

namespace App\DomainModel\Repository;

use App\Entity\EarthScientist;

interface EarthScientistRepository
{
    public function existsCheckByApikey(string $apikey): bool;
    public function findByApikey(string $apikey): EarthScientist;
}
