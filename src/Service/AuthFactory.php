<?php

namespace App\Service;

use App\Repository\EarthScientistRepository;
use App\Repository\UserRepository;
use App\Shared\Domain\Exception\NotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthFactory
{
    private UserRepository $userRepository;
    private MarsScientistRepository $marsScientistRepository;
    private SpaceScientistRepository $spaceScientistRepository;
    private EarthScientistRepository $earthScientistRepository;

    public function __construct(UserRepository $userRepository,
                                MarsScientistRepository $marsScientistRepository,
                                SpaceScientistRepository $spaceScientistRepository,
                                EarthScientistRepository $earthScientistRepository)
    {
        $this->userRepository = $userRepository;
        $this->marsScientistRepository = $marsScientistRepository;
        $this->spaceScientistRepository = $spaceScientistRepository;
        $this->earthScientistRepository = $earthScientistRepository;
    }


    public function createFromUser(UserInterface $user): AbstractScientist
    {
        $scientist = null;
        $user = $this->userRepository->findOneBy(['apikey' => $user->getUsername()]);

        if (empty($user) === true) {
            throw new NotFoundException();
        }

        if ($this->earthScientistStore->existsCheckByApikey($user->getUsername())) {
            $scientist = $this->earthScientistStore->findByApikey($user->getUsername());
        }

        if ($this->marsScientistStore->existsCheckByApikey($user->getUsername())) {
            $scientist = $this->earthScientistStore->findByApikey($user->getUsername());
        }

        if ($this->spaceScientistStore->existsCheckByApikey($user->getUsername())) {
            $scientist = $this->earthScientistStore->findByApikey($user->getUsername());
        }


        if (empty($scientist) === true) {
            throw new NotFoundException();
        }

    }
}
