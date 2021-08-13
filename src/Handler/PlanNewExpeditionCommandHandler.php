<?php

declare(strict_types=1);

namespace App\Handler;

use App\Application\Expedition\Application\Command\PlanNewExpeditionCommand;
use App\Application\Expedition\Application\Event\PlannedNewExpedition;
use App\Application\Expedition\Domain\Expedition;
use App\Application\Expedition\Domain\Repository\ExpeditionRepositoryInterface;
use App\Application\Shared\Domain\Event\EventRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class PlanNewExpeditionCommandHandler implements MessageHandlerInterface
{
    private ExpeditionRepositoryInterface $repository;
    private EventRepositoryInterface $eventRepository;

    public function __construct(ExpeditionRepositoryInterface $repository, EventRepositoryInterface $eventRepository)
    {
        $this->repository = $repository;
        $this->eventRepository = $eventRepository;
    }

    public function __invoke(PlanNewExpeditionCommand $command)
    {
        $expedition = Expedition::planNewExpedition(null, $command->plannedStartDate);

        $this->repository->save($expedition);
        $this->eventRepository->save(new PlannedNewExpedition());
    }
}