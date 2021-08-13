<?php

declare(strict_types=1);

namespace App\Handler;

//TODO tests
use App\Application\Shared\Domain\Event\EventRepositoryInterface;
use App\Command\FinishExpeditionCommand;
use App\Event\FinishedExpedition;
use App\Service\ExpeditionRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class FinishExpeditionCommandHandler implements MessageHandlerInterface
{
    private ExpeditionRepositoryInterface $repository;
    private EventRepositoryInterface $eventRepository;

    public function __construct(ExpeditionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(FinishExpeditionCommand $command)
    {
        $expedition = $this->repository->getById($command->id);
        $expedition->finishExpedition();

        $this->repository->save($expedition);
        $this->eventRepository->save(new FinishedExpedition());
    }
}