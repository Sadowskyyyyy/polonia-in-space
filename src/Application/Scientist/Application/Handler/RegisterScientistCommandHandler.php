<?php

declare(strict_types=1);

namespace App\Application\Scientist\Application\Handler;

use App\Application\Scientist\Application\Command\RegisterScientistCommand;
use App\Application\Scientist\Domain\MarsScientist\MarsScientist;
use App\Application\Scientist\Domain\MarsScientist\Repository\MarsScientistRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class RegisterScientistCommandHandler implements MessageSubscriberInterface
{
    private MarsScientistRepositoryInterface $repository;

    public function __construct(MarsScientistRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(RegisterScientistCommand $command)
    {
        $scientist = MarsScientist::createNewScientist($command->name, $command->surname);

        $this->repository->save($scientist);
    }
}