<?php
declare(strict_types=1);

namespace App\Expeditions\Infrastructure\Memory\Repository;

use App\Expeditions\Domain\Entity\MarsScientist;
use App\Expeditions\Domain\Entity\User;
use App\Expeditions\Domain\MarsScientistRepository;
use Doctrine\Common\Collections\ArrayCollection;

class MemoryMarsScientistRepository implements MarsScientistRepository
{
    public function existsCheckByApikey(string $apikey): bool
    {
        return true;
    }

    public function findByApikey(string $apikey): MarsScientist
    {
        return new MarsScientist(
            1,
            'test',
            false,
            false,
            new ArrayCollection(),
            new User([], 'apikey')
        );
    }
}
