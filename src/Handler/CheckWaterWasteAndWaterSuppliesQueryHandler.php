<?php
declare(strict_types=1);

namespace App\Handler;

use App\DomainModel\SpaceResearchStation;
use App\Query\CheckDaysAtOrbitQuery;
use App\Query\CheckWaterWasteAndWaterSuppliesQuery;
use App\Service\ResarchStationRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CheckWaterWasteAndWaterSuppliesQueryHandler implements MessageHandlerInterface
{
    private ResarchStationRepositoryInterface $stationRepository;

    public function __construct(ResarchStationRepositoryInterface $stationRepository)
    {
        $this->stationRepository = $stationRepository;
    }

    public function __invoke(CheckWaterWasteAndWaterSuppliesQuery $query): float
    {
        /**@var SpaceResearchStation $researchStation */
        $researchStation = $this->stationRepository->getResarchStationByName('spacestation');

        return $researchStation->getWaterWaste();
    }
}
