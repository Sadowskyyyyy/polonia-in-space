<?php
declare(strict_types=1);

namespace App\Expeditions\Application\Handler;

use App\Expeditions\Application\Command\DeleteExpeditionCommand;
use App\Expeditions\Domain\ExpeditionRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class DeleteExpeditionCommandHandler implements MessageHandlerInterface
{
    private ExpeditionRepository $repository;

    public function __construct(ExpeditionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(DeleteExpeditionCommand $command): void
    {
        $expedition = $this->repository->findById($command->id);

        $this->repository->delete($expedition);
    }
}
