<?php
declare(strict_types=1);

namespace App\UI\Rest\Controller\Expedition;

use App\Query\GenerateExpeditionConclusionQuery;
use App\UI\Rest\Controller\QueryController;
use JsonApiPhp\JsonApi\Attribute;
use JsonApiPhp\JsonApi\DataDocument;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\ResourceObject;
use Symfony\Component\HttpFoundation\Response;
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
    public function generateExpeditionConclusion(int $id): Response
    {
        $response = $this->ask(new GenerateExpeditionConclusionQuery($id));

        return $this->json(
            new DataDocument(
                new ResourceObject(
                    'expedition',
                    (string)$id,
                    new Attribute('conclusion', $response),
                    new SelfLink('expeditions/conclusion/'.$id)
                )
            )
        );
    }
}
