<?php
declare(strict_types=1);

namespace App\Handler;

use App\DomainModel\SpaceResearchStation;
use App\Query\CheckEnergyWasteQuery;
use App\Service\ResarchStationRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CheckEnergyWasteQueryHandler implements MessageHandlerInterface
{
    private ResarchStationRepositoryInterface $stationRepository;

    public function __construct(ResarchStationRepositoryInterface $stationRepository)
    {
        $this->stationRepository = $stationRepository;
    }

    public function __invoke(CheckEnergyWasteQuery $query): float
    {
        /**@var SpaceResearchStation $researchStation */
        $researchStation = $this->stationRepository->getResarchStationByName('spacestation');

        return $researchStation->getEnergyWaste();
    }
}
