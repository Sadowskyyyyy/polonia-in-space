<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\ResarchStation;

use App\Query\CheckDemandQuery;
use App\UI\Rest\Controller\QueryController;
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
    public function checkDemand(Request $request): Response
    {
        $direction = $request->query->get('destination');
        $response = $this->askWithDelay(new CheckDemandQuery($direction));

    }

    /**
     * @IsGranted("ROLE_EARTH_SCIENTIST")
     * @Route("/spacestation/oxygen")
     */
    public function checkOxygen(Request $request): Response
    {
        $response = $this->askWithDelay(new CheckOxygenQuery());
    }

    /**
     * @IsGranted("ROLE_EARTH_SCIENTIST")
     * @Route("/spacestation/mass")
     */
    public function checkMass(Request $request): Response
    {
        $response = $this->askWithDelay(new CheckMassQuery());
    }

    /**
     * @IsGranted("ROLE_EARTH_SCIENTIST")
     * @Route("/spacestation/orbitdays")
     */
    public function checkDaysAtOrbit(Request $request): Response
    {
        $response = $this->askWithDelay(new CheckDaysAtOrbitQuery());
    }

    /**
     * @IsGranted("ROLE_EARTH_SCIENTIST")
     * @Route("/spacestation/energy")
     */
    public function checkDaysAtOrbit(Request $request): Response
    {
        $response = $this->askWithDelay(new CheckEnergyWasteQuery());
    }

    /**
     * @IsGranted("ROLE_EARTH_SCIENTIST")
     * @Route("/spacestation/accumulators")
     */
    public function checkDaysAtOrbit(Request $request): Response
    {
        $response = $this->askWithDelay(new CheckAccumulatorsQuery());
    }
    /**
     * @IsGranted("ROLE_EARTH_SCIENTIST")
     * @Route("/spacestation/water")
     */
    public function checkDaysAtOrbit(Request $request): Response
    {
        $response = $this->askWithDelay(new CheckWaterWasteAndWaterSuppliesQuery());
    }


}