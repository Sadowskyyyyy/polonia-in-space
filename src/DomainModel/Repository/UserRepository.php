<?php
declare(strict_types=1);

namespace App\DomainModel\Repository;

use App\Entity\User;

interface UserRepository
{
    public function findOneByApikey(string $apikey): User;
    public function save(User $user): void;
    public function findById(int $id);
}
