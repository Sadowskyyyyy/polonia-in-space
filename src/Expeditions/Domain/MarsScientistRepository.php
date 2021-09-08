<?php
declare(strict_types=1);

namespace App\Expeditions\Domain;

use App\Entity\MarsScientistEntity;

interface MarsScientistRepository
{
    public function existsCheckByApikey(string $apikey): bool;
    public function findByApikey(string $apikey): MarsScientistEntity;
}
