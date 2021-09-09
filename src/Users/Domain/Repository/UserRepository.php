<?php
declare(strict_types=1);

namespace App\Users\Domain\Repository;

use App\Expeditions\Domain\Entity\User;

interface UserRepository
{
    public function findById(int $id): User;
    public function findOneByApikey(string $apikey): User;
    public function save(User $user): void;
}
