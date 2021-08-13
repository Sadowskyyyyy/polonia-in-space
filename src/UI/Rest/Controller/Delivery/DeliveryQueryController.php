<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Delivery;

use App\Query\CheckDeliveryStatusQuery;
use App\UI\Rest\Controller\QueryController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

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
    public function checkStatus(Request $request, int $id): Response
    {
        $destination = $request->query->get('destination');
        $response = $this->ask(new CheckDeliveryStatusQuery($id, $destination));
    }
}
