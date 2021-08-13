<?php
declare(strict_types=1);

namespace App\UI\Rest\Controller\Expedition;

use App\Query\GenerateExpeditionConclusionQuery;
use App\UI\rest\Controller\QueryController;
use Symfony\Component\Messenger\MessageBusInterface;
use Tobscure\JsonApi\Resource;

/**
 * @Route("/expeditions")
 */
class ExpeditionQueryController extends QueryController
{
    public function __construct(MessageBusInterface $queryBus)
    {
        parent::__construct($queryBus);
    }

    /**
     * @Route("/conclusion/{id}", methods={"GET"})
     */
    public function generateExpeditionConclusion(int $id): Resource
    {
        $response = $this->ask(new GenerateExpeditionConclusionQuery($id));
    }
}
