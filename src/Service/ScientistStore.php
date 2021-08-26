<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\EarthScientist;
use App\Entity\MarsScientistEntity;
use App\Entity\SpaceScientist;
use App\Shared\Domain\Exception\NotFoundException;
use Doctrine\ORM\EntityManagerInterface;

class ScientistStore
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getScientistByRoleAndName(string $name, string $password, string $roles)
    {
        $user = null;

        switch ($roles) {
            case 'ROLE_MARS_SCIENTIST':
                $user = $this->entityManager->getRepository(MarsScientistEntity::class)
                    ->findOneBy(['name' => $name]);
            case 'ROLE_EARTH_SCIENTIST':
                $user = $this->entityManager->getRepository(EarthScientist::class)
                    ->findOneBy(['name' => $name]);
            case 'ROLE_SPACE_SCIENTIST':
                $user = $this->entityManager->getRepository(SpaceScientist::class)
                    ->findOneBy(['name' => $name]);
        }

        if (empty($user) === true) {
            throw new NotFoundException();
        }

        return $user;
    }
}
