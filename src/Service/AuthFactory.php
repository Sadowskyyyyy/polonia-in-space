<?php
declare(strict_types=1);

namespace App\Service;

use App\DomainModel\Repository\EarthScientistRepository;
use App\DomainModel\Repository\MarsScientistRepository;
use App\DomainModel\Repository\SpaceScientistRepository;
use App\DomainModel\Repository\UserRepository;
use App\Entity\EarthScientist;
use App\Entity\MarsScientistEntity;
use App\Entity\SpaceScientist;
use App\Shared\Domain\Exception\NotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthFactory
{
    private UserRepository $userRepository;
    private MarsScientistRepository $marsScientistRepository;
    private SpaceScientistRepository $spaceScientistRepository;
    private EarthScientistRepository $earthScientistRepository;

    public function __construct(
        UserRepository $userRepository,
        MarsScientistRepository $marsScientistRepository,
        SpaceScientistRepository $spaceScientistRepository,
        EarthScientistRepository $earthScientistRepository
    ) {
        $this->userRepository = $userRepository;
        $this->marsScientistRepository = $marsScientistRepository;
        $this->spaceScientistRepository = $spaceScientistRepository;
        $this->earthScientistRepository = $earthScientistRepository;
    }

    public function createFromUser(UserInterface $user): EarthScientist|MarsScientistEntity|SpaceScientist
    {
        $scientist = null;
        $user = $this->userRepository->findOneByApikey($user->getUsername());

        if (true === empty($user)) {
            throw new NotFoundException();
        }

        if ($this->earthScientistRepository->existsCheckByApikey($user->getUsername())) {
            $scientist = $this->earthScientistRepository->findByApikey($user->getUsername());
        }

        if ($this->marsScientistRepository->existsCheckByApikey($user->getUsername())) {
            $scientist = $this->marsScientistRepository->findByApikey($user->getUsername());
        }

        if ($this->spaceScientistRepository->existsCheckByApikey($user->getUsername())) {
            $scientist = $this->spaceScientistRepository->findByApikey($user->getUsername());
        }

        if (true === empty($scientist)) {
            throw new NotFoundException();
        }

        return $scientist;
    }
}
