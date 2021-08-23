<?php
declare(strict_types=1);

namespace App\Handler;

//TODO tests
use App\Command\MarkMarsScientistAsMissingOrDeadCommand;
use App\Event\MarsScientistHasBeenMarkedAsDeadOrMissing;
use App\Service\MarsScientistRepositoryInterface;
use App\Shared\Domain\Event\EventRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class MarkMarsScientistAsMissingOrDeadCommandHandler implements MessageHandlerInterface
{
    private MarsScientistRepositoryInterface $repository;
    private EventRepositoryInterface $eventRepository;

    public function __construct(MarsScientistRepositoryInterface $repository, EventRepositoryInterface $eventRepository)
    {
        $this->repository = $repository;
        $this->eventRepository = $eventRepository;
    }

    public function __invoke(MarkMarsScientistAsMissingOrDeadCommand $command)
    {
        $scientist = $this->repository->getById($command->id);

        if (true === $command->isMissing) {
            $scientist->markAsMissing();
        }

        if (true === $command->isDead) {
            $scientist->markAsDead();
            $scientist->setReasonOfDeath($command->reason);
        }

        $this->repository->save($scientist);
        $this->eventRepository->save(new MarsScientistHasBeenMarkedAsDeadOrMissing());
    }
}
