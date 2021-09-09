<?php
declare(strict_types=1);

namespace App\Expeditions\Domain;

use App\Expeditions\Domain\Entity\User;

interface UserRepository
{
    public function findOneByApikey(string $apikey): User;
}
