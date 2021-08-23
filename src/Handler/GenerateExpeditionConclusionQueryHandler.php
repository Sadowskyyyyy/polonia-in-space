<?php
declare(strict_types=1);

namespace App\Handler;

use App\Query\GenerateExpeditionConclusionQuery;
use App\Service\ExpeditionRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class GenerateExpeditionConclusionQueryHandler implements MessageHandlerInterface
{
    private ExpeditionRepositoryInterface $expeditionRepository;

    public function __construct(ExpeditionRepositoryInterface $expeditionRepository)
    {
        $this->expeditionRepository = $expeditionRepository;
    }

    public function __invoke(GenerateExpeditionConclusionQuery $query)
    {
        $expedition = $this->expeditionRepository->getById($query->id);

        return $expedition->generateExpeditionConclusion();
    }
}
