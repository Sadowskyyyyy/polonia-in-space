<?php
declare(strict_types=1);

namespace App\UI\Rest\Controller\ResarchStation;

use App\Query\CheckDemandQuery;
use App\UI\Rest\Controller\QueryController;
use JsonApiPhp\JsonApi\Attribute;
use JsonApiPhp\JsonApi\DataDocument;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\ResourceObject;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class ResearchStationQueryController extends QueryController
{
    public function __construct(MessageBusInterface $queryBus)
    {
        parent::__construct($queryBus);
    }

    /**
     * @Route("/researchstations/demand", name="DEMAND")
     */
    public function checkDemand(Request $request): Response
    {
        $direction = $request->query->get('destination');
        $response = $this->askWithDelay(new CheckDemandQuery($direction));

        return $this->json(
            new DataDocument(
                new ResourceObject(
                    'research_station',
                    '1',
                    new Attribute('demand', $response),
                    new SelfLink('/researchstations/demand')
                )
            )
        );
    }
}
