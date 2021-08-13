<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Delivery;

use App\Command\SendDeliveryCommand;
use App\UI\Rest\Controller\CommandController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use function json_decode;

/**
 * @Route("/deliveries")
 */
class DeliveryCommandController extends CommandController
{
    public function __construct(MessageBusInterface $bus)
    {
        parent::__construct($bus);
    }

    /**
     * @Route("/deliveries", methods={"POST"})
     */
    public function sendDelivery(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $destination = $request->query->get('destination');
        $command = new SendDeliveryCommand($data['category'], $destination);
    }
}
