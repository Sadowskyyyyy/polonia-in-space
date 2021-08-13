<?php

declare(strict_types=1);

namespace App\Handler;

use App\Application\Scientist\Application\Command\MarkMarsScientistAsMissingOrDeadCommand;
use App\Application\Scientist\Application\Event\MarsScientistHasBeenMarkedAsDeadOrMissing;
use App\Application\Scientist\Domain\MarsScientist\Repository\MarsScientistRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

//TODO tests
class MarkMarsScientistAsMissingOrDeadCommandHandler implements MessageHandlerInterface
{
    private MarsScientistRepositoryInterface $repository;

    private EventRepositoryInterface $eventRepository;

    public function __construct(MarsScientistRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(MarkMarsScientistAsMissingOrDeadCommand $command)
    {
        $scientist = $this->repository->getById($command->id);

        if ($command->isMissing === true) {
            $scientist->markAsMissing();
            $scientist->setReasonOfDeath($command->reason);
        }
        if ($command->isDead === true) {
            $scientist->markAsDead();
            $scientist->setReasonOfDeath($command->reason);
        }

        $this->repository->save($scientist);
        $this->eventRepository->save(new MarsScientistHasBeenMarkedAsDeadOrMissing());
    }
}