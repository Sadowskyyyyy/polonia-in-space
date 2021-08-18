<?php
declare(strict_types=1);

namespace App\Handler;

use App\Command\StartExpeditionCommand;
use App\Event\StartedExpedition;
use App\Service\ExpeditionRepositoryInterface;
use App\Shared\Domain\Event\EventRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class StartExpeditionCommandHandler implements MessageHandlerInterface
{
    private ExpeditionRepositoryInterface $repository;
    private EventRepositoryInterface $eventRepository;

    public function __construct(ExpeditionRepositoryInterface $repository, EventRepositoryInterface $eventRepository)
    {
        $this->repository = $repository;
        $this->eventRepository = $eventRepository;
    }

    public function __invoke(StartExpeditionCommand $command)
    {
        $expedition = $this->repository->getById($command->id);
        $expedition->start();

        $this->repository->save($expedition);
        $this->eventRepository->save(new StartedExpedition());
    }
}
