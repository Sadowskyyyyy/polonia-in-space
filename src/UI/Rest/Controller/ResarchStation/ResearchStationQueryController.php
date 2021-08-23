<?php
declare(strict_types=1);

namespace App\UI\Rest\Controller\ResarchStation;

use App\Application\ResarchStation\Application\Query\CheckDemand;
use App\UI\Rest\Controller\QueryController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/researchstations")
 */
class ResearchStationQueryController extends QueryController
{
    public function __construct(MessageBusInterface $queryBus)
    {
        parent::__construct($queryBus);
    }

    /**
     * @Route("/demand")
     */
    public function checkDemand(Request $request): Response
    {
        $direction = $request->query->get('destination');
        $response = $this->askWithDelay(new CheckDemand($direction));

    }
}
