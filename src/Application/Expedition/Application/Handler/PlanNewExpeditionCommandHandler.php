<?php

declare(strict_types=1);

namespace App\Application\Expedition\Application\Handler;

use App\Application\Expedition\Application\Command\PlanNewExpeditionCommand;
use App\Application\Expedition\Domain\Expedition;
use App\Application\Expedition\Domain\Repository\ExpeditionRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class PlanNewExpeditionCommandHandler implements MessageHandlerInterface
{
    private ExpeditionRepositoryInterface $repository;

    public function __construct(ExpeditionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(PlanNewExpeditionCommand $command)
    {
        //TODO make security users :p
        $expedition = Expedition::planNewExpedition(null, $command->plannedStartDate);

        $this->repository->save($expedition);
    }
}