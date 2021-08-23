<?php

declare(strict_types=1);

namespace App\Application\Expedition\Application\Handler;

use App\Application\Expedition\Application\Command\FinishExpeditionCommand;
use App\Application\Expedition\Domain\Repository\ExpeditionRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class FinishExpeditionCommandHandler implements MessageHandlerInterface
{
    private ExpeditionRepositoryInterface $repository;

    public function __construct(ExpeditionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(FinishExpeditionCommand $command)
    {
        $expedition = $this->repository->getById($command->id);
        $expedition->finishExpedition();

        $this->repository->save($expedition);
    }
}
