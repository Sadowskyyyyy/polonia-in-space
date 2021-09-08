<?php
declare(strict_types=1);

namespace App\Infrastructure\Memory\Repository;

use App\DomainModel\Repository\MarsScientistRepository;
use App\Entity\MarsScientistEntity;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;

class MemoryMarsScientistRepository implements MarsScientistRepository
{
    public function existsCheckByApikey(string $apikey): bool
    {
        return true;
    }

    public function findByApikey(string $apikey): MarsScientistEntity
    {
        return new MarsScientistEntity(
            1,
            'test',
            false,
            false,
            new ArrayCollection(),
            new User([], 'apikey')
        );
    }
}
