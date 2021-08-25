<?php
declare(strict_types=1);

namespace App\UI\Rest\Controller\ResarchStation;

use App\Application\ResarchStation\Application\Query\CheckDemand;
use App\Query\CheckOxygenQuery;
use App\UI\Rest\Controller\QueryController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use JsonApiPhp\JsonApi\Attribute;
use JsonApiPhp\JsonApi\DataDocument;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\ResourceObject;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

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

    /**
     * @IsGranted("ROLE_EARTH_SCIENTIST")
     * @Route("/spacestation/oxygen")
     */
    public function checkOxygen(Request $request): string
    {
        $response = $this->askWithDelay(new CheckOxygenQuery());

        return json_encode(new DataDocument(
                new ResourceObject(
                    'spacestations',
                    '1',
                    new Attribute('oxygen_percentage', $response),
                    new SelfLink('/spacestation/oxygen')
                )
            )
        );
    }
}
