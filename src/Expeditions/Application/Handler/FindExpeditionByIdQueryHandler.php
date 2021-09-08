<?php
declare(strict_types=1);

namespace App\Expeditions\Application\Handler;

use App\Entity\Expedition;
use App\Expeditions\Application\Query\FindExpeditionByIdQuery;
use App\Expeditions\Domain\ExpeditionRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class FindExpeditionByIdQueryHandler implements MessageHandlerInterface
{
    private ExpeditionRepository $expeditionRepository;

    public function __construct(ExpeditionRepository $expeditionRepository)
    {
        $this->expeditionRepository = $expeditionRepository;
    }

    public function __invoke(FindExpeditionByIdQuery $query): Expedition
    {
        return $this->expeditionRepository->findById($query->id);
    }
}
