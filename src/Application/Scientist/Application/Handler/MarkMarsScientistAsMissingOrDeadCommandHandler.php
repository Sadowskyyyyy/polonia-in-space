<?php

declare(strict_types=1);

namespace App\Application\Scientist\Application\Handler;

use App\Application\Scientist\Application\Command\MarkMarsScientistAsMissingOrDeadCommand;
use App\Application\Scientist\Domain\MarsScientist\Repository\MarsScientistRepositoryInterface;

//TODO tests
class MarkMarsScientistAsMissingOrDeadCommandHandler implements MessageSubscriberInterface
{
    private MarsScientistRepositoryInterface $repository;

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
    }
}