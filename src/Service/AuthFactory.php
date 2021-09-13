<?php
declare(strict_types=1);

namespace App\Service;

use App\Expeditions\Domain\Entity\User;
use App\Users\Domain\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthFactory
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createFromUser(UserInterface $user): User
    {
        return $this->userRepository->findById((int) $user->getUserIdentifier());
    }
}
