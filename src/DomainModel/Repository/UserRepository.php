<?php
declare(strict_types=1);

namespace App\DomainModel\Repository;

use App\Entity\User;

interface UserRepository
{
    public function findOneByApikey(string $apikey): User;
}
