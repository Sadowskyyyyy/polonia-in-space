<?php
declare(strict_types=1);

namespace App\Handler;

//TODO tests

use App\Command\FinishExpeditionCommand;
use App\Event\FinishedExpedition;
use App\Service\ExpeditionRepositoryInterface;
use App\Shared\Domain\Event\EventRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class FinishExpeditionCommandHandler implements MessageHandlerInterface
{
    private ExpeditionRepositoryInterface $repository;
    private EventRepositoryInterface $eventRepository;

    public function __construct(ExpeditionRepositoryInterface $repository, EventRepositoryInterface $eventRepository)
    {
        $this->repository = $repository;
        $this->eventRepository = $eventRepository;
    }


    public function __invoke(FinishExpeditionCommand $command)
    {
        $expedition = $this->repository->getById($command->id);
        $expedition->finish();

        $this->repository->save($expedition);
        $this->eventRepository->save(new FinishedExpedition());
    }
}
