<?php
declare(strict_types=1);

namespace App\Handler;

use App\DomainModel\SpaceResearchStation;
use App\Query\CheckOxygenQuery;
use App\Service\ResarchStationRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CheckOxygenQueryHandler implements MessageHandlerInterface
{
    private ResarchStationRepository $stationRepository;

    public function __construct(ResarchStationRepository $stationRepository)
    {
        $this->stationRepository = $stationRepository;
    }

    public function __invoke(CheckOxygenQuery $query): float
    {
        /**@var SpaceResearchStation $researchStation*/
        $researchStation = $this->stationRepository->getResarchStationByName('spacestation');

        return $researchStation->getOxygenPercentage();
    }
}
