<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Delivery;

use App\Query\CheckDeliveryStatusQuery;
use App\UI\Rest\Controller\QueryController;
use JsonApiPhp\JsonApi\Attribute;
use JsonApiPhp\JsonApi\DataDocument;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\ResourceObject;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/deliveries")
 */
class DeliveryQueryController extends QueryController
{
    public function __construct(MessageBusInterface $queryBus)
    {
        parent::__construct($queryBus);
    }

    /**
     * @Route("/{id}}")
     */
    public function checkStatus(Request $request, int $id): string
    {
        $destination = $request->query->get('destination');
        $response = $this->ask(new CheckDeliveryStatusQuery($id, $destination));

        return json_encode(
            new DataDocument(
            new ResourceObject(
                    'deliverie',
                    (string) $id,
                    new Attribute('delivery', $response),
                    new SelfLink(sprintf('/deliveries/%d', $id))
                )
        )
        );
    }
}
