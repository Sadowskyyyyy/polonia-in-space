<?php
declare(strict_types=1);

namespace App\Expeditions\Domain;

use App\Expeditions\Domain\Entity\MarsScientist;

interface MarsScientistRepository
{
    public function existsCheckByApikey(string $apikey): bool;
    public function findByApikey(string $apikey): MarsScientist;
}
