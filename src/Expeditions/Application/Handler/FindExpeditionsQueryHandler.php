<?php
declare(strict_types=1);

namespace App\Expeditions\Application\Handler;

use App\Expeditions\Application\Query\FindExpeditionsQuery;
use App\Expeditions\Domain\ExpeditionRepository;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class FindExpeditionsQueryHandler implements MessageHandlerInterface
{
    private ExpeditionRepository $expeditionRepository;

    public function __construct(ExpeditionRepository $expeditionRepository)
    {
        $this->expeditionRepository = $expeditionRepository;
    }

    public function __invoke(FindExpeditionsQuery $query): Envelope
    {
        return new Envelope($this->expeditionRepository->findAll());
    }
}
