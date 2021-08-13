<?php

declare(strict_types=1);

namespace App\Handler;

use App\Application\Scientist\Application\Command\RegisterScientistCommand;
use App\Application\Scientist\Application\Event\MarsScientistCreated;
use App\Application\Scientist\Domain\MarsScientist\MarsScientist;
use App\Application\Scientist\Domain\MarsScientist\Repository\MarsScientistRepositoryInterface;
use App\Application\Scientist\Domain\Validation\RegisterScientistCommandValidator;
use App\Application\Shared\Domain\Event\EventRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class RegisterScientistCommandHandler implements MessageHandlerInterface
{
    private MarsScientistRepositoryInterface $repository;

    private EventRepositoryInterface $eventRepository;

    private RegisterScientistCommandValidator $validator;

    public function __construct(MarsScientistRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(RegisterScientistCommand $command)
    {
        $this->validator->isValid($command);
        $scientist = MarsScientist::createNewScientist($command->name, $command->surname);

        $this->repository->save($scientist);
        $this->eventRepository->save(new MarsScientistCreated());
    }
}