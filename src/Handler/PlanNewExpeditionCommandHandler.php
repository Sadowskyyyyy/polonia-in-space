<?php
declare(strict_types=1);

namespace App\Handler;

use App\Command\PlanNewExpeditionCommand;
use App\DomainModel\Expedition;
use App\Event\PlannedNewExpedition;
use App\Service\ExpeditionRepositoryInterface;
use App\Shared\Domain\Event\EventRepositoryInterface;
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
