<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\MarsScientist;

use App\Query\GetAllScientistsFromMarsResearchStationQuery;
use App\UI\rest\Controller\QueryController;
use JsonApiPhp\JsonApi\Attribute;
use JsonApiPhp\JsonApi\DataDocument;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\ResourceObject;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

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
     * @IsGranted("ROLE_MARS_SCIENTIST")
     */
    public function getScientists(Request $request): Response
    {
        $response = $this->ask(new GetAllScientistsFromMarsResearchStationQuery());

        $response = json_encode(new DataDocument(
                new ResourceObject(
                    'scientists',
                    '1',
                    new Attribute('scientists', $response),
                    new SelfLink('/marsscientists')
                )
            )
        );

        return $this->json(json_decode($response));
    }
}
