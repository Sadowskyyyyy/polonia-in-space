<?php
declare(strict_types=1);

namespace App\UI\Rest\Controller\Expedition;

use App\Query\GenerateExpeditionConclusionQuery;
use App\UI\rest\Controller\QueryController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

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
    public function generateExpeditionConclusion(int $id): JsonResponse
    {
        $response = $this->ask(new GenerateExpeditionConclusionQuery($id));

        return json_encode(
            new DataDocument(
                new ResourceObject(
                    'expedition',
                    '1',
                    new Attribute('expedition_conclusion', $response),
                    new SelfLink(sprintf('/conclusion/%s', $id))
                )
            )
        );
    }
}
