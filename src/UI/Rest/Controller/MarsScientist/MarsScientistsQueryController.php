<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\MarsScientist;

use App\Query\GetAllScientistsFromMarsResearchStationQuery;
use App\UI\rest\Controller\QueryController;
use JsonApiPhp\JsonApi\CompoundDocument;
use JsonApiPhp\JsonApi\ResourceIdentifierCollection;
use JsonApiPhp\JsonApi\ResourceObject;
use JsonApiPhp\JsonApi\ToMany;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * @Route("/marsscientists")
 */
class MarsScientistsQueryController extends QueryController
{
    public function __construct(MessageBusInterface $queryBus)
    {
        parent::__construct($queryBus);
    }

    /**
     * @Route("/marsscientists")
     * @IsGranted("ROLE_MARS_SCIENTIST")
     */
    public function getScientists(Request $request): Response
    {
        $response = $this->ask(new GetAllScientistsFromMarsResearchStationQuery());


    }
}
