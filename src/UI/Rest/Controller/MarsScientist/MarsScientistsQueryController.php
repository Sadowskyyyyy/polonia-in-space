<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\MarsScientist;

use App\Query\GetAllScientistsFromMarsResearchStationQuery;
use App\UI\rest\Controller\QueryController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;

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

        return json_encode(new DataDocument(
            new ResourceObject(
                'scientists',
                '1',
                new Attribute('oxygen_percentage', $response),
                new SelfLink('/spacestation/oxygen')
            )),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
        );
    }
}
