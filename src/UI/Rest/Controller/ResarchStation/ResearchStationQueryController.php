<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\ResarchStation;

use App\Query\CheckAccumulatorsQuery;
use App\Query\CheckDaysAtOrbitQuery;
use App\Query\CheckDemandQuery;
use App\Query\CheckEnergyWasteQuery;
use App\Query\CheckMassQuery;
use App\Query\CheckOxygenQuery;
use App\Query\CheckWaterWasteAndWaterSuppliesQuery;
use App\UI\Rest\Controller\QueryController;
use JsonApiPhp\JsonApi\Attribute;
use JsonApiPhp\JsonApi\DataDocument;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\ResourceObject;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

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
    public function checkDemand(Request $request): string
    {
        $direction = $request->query->get('destination');
        $response = $this->askWithDelay(new CheckDemandQuery($direction));

        return json_encode(new DataDocument(
            new ResourceObject(
                'spacestations',
                '1',
                new Attribute('demand', $response),
                new SelfLink('/spacestation/demand')
            )),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
        );
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
            )),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
        );
    }

    /**
     * @IsGranted("ROLE_EARTH_SCIENTIST")
     * @Route("/spacestation/mass")
     */
    public function checkMass(Request $request): string
    {
        $response = $this->askWithDelay(new CheckMassQuery());

        return json_encode(new DataDocument(
            new ResourceObject(
                'spacestations',
                '1',
                new Attribute('mass', $response),
                new SelfLink('/spacestation/mass')
            )),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
        );
    }

    /**
     * @IsGranted("ROLE_EARTH_SCIENTIST")
     * @Route("/spacestation/orbitdays")
     */
    public function checkDaysAtOrbit(Request $request): string
    {
        $response = $this->askWithDelay(new CheckDaysAtOrbitQuery());

        return json_encode(new DataDocument(
            new ResourceObject(
                'spacestations',
                '1',
                new Attribute('days_at_orbit', $response),
                new SelfLink('/spacestation/orbitdays')
            )),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
        );
    }

    /**
     * @IsGranted("ROLE_EARTH_SCIENTIST")
     * @Route("/spacestation/energy")
     */
    public function checkEnergyWaste(Request $request): string
    {
        $response = $this->askWithDelay(new CheckEnergyWasteQuery());

        return json_encode(new DataDocument(
            new ResourceObject(
                'spacestations',
                '1',
                new Attribute('energy_waste', $response),
                new SelfLink('/spacestation/energy')
            )),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
        );
    }

    /**
     * @IsGranted("ROLE_EARTH_SCIENTIST")
     * @Route("/spacestation/accumulators")
     */
    public function checkAccumulators(Request $request): string
    {
        $response = $this->askWithDelay(new CheckAccumulatorsQuery());

        return json_encode(new DataDocument(
            new ResourceObject(
                'spacestations',
                '1',
                new Attribute('accumulators_percentage', $response),
                new SelfLink('/spacestation/accumulators')
            )),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
        );
    }

    /**
     * @IsGranted("ROLE_EARTH_SCIENTIST")
     * @Route("/spacestation/water")
     */
    public function checkWaterAndSupplies(Request $request): string
    {
        $response = $this->askWithDelay(new CheckWaterWasteAndWaterSuppliesQuery());

        return json_encode(new DataDocument(
            new ResourceObject(
                'spacestations',
                '1',
                new Attribute('waterwaste', $response),
                new SelfLink('/spacestation/water')
            )),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
        );
    }
}
