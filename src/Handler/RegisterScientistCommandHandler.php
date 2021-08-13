<?php
declare(strict_types=1);

namespace App\Handler;

use App\Command\RegisterScientistCommand;
use App\DomainModel\MarsScientist;
use App\Event\MarsScientistCreated;
use App\Service\MarsScientistRepositoryInterface;
use App\Service\RegisterScientistCommandValidator;
use App\Shared\Domain\Event\EventRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

//TODO tests
class RegisterScientistCommandHandler implements MessageHandlerInterface
{
    private MarsScientistRepositoryInterface $repository;

    private EventRepositoryInterface $eventRepository;

    private RegisterScientistCommandValidator $validator;

    public function __construct(MarsScientistRepositoryInterface $repository, EventRepositoryInterface $eventRepository, RegisterScientistCommandValidator $validator)
    {
        $this->repository = $repository;
        $this->eventRepository = $eventRepository;
        $this->validator = $validator;
    }

    public function __invoke(RegisterScientistCommand $command)
    {
        $this->validator->isValid($command);
        $scientist = MarsScientist::createNewScientist($command->name, $command->surname);

        $this->repository->save($scientist);
        $this->eventRepository->save(new MarsScientistCreated());
    }
}
