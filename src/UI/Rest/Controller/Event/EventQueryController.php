<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Event;

use App\UI\rest\Controller\QueryController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/events")
 */
class EventQueryController extends QueryController
{
    public function __construct(MessageBusInterface $bus)
    {
        parent::__construct($bus);
    }

    public function getLast100EventsFromSpaceStation(Request $request): Response
    {
        $query = new

        $this->askWithDelay($query);
    }
    public function getEventsFromSpaceStation(Request $request): Response
    {
        $query = new

        $this->askWithDelay($query);
    }

}