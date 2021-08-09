<?php

declare(strict_types=1);

namespace App\Application\Scientist\Application\Handler;

use App\Application\Scientist\Application\Command\RegisterScientistCommand;
use App\Application\Scientist\Domain\MarsScientist;
use Doctrine\ORM\EntityManagerInterface;

class RegisterScientistCommandHandler implements MessageSubscriberInterface
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(RegisterScientistCommand $command)
    {
        $scientist = MarsScientist::createNewScientist($command->name, $command->surname);
        //TODO save to database
    }

}