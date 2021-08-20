<?php
declare(strict_types=1);

namespace App\UI\Rest\Controller\Expedition;

use App\Query\GenerateExpeditionConclusionQuery;
use App\UI\rest\Controller\QueryController;
use JsonApiPhp\JsonApi\Attribute;
use JsonApiPhp\JsonApi\DataDocument;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\ResourceObject;
use Symfony\Component\Messenger\MessageBusInterface;

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
    public function generateExpeditionConclusion(int $id): string
    {
        $response = $this->ask(new GenerateExpeditionConclusionQuery($id));

        return json_encode(new DataDocument(
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
