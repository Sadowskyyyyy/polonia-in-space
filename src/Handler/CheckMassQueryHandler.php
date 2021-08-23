<?php
declare(strict_types=1);

namespace App\Handler;

use App\DomainModel\SpaceResearchStation;
use App\Query\CheckMassQuery;
use App\Service\ResarchStationRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CheckMassQueryHandler implements MessageHandlerInterface
{
    private ResarchStationRepositoryInterface $stationRepository;

    public function __construct(ResarchStationRepositoryInterface $stationRepository)
    {
        $this->stationRepository = $stationRepository;
    }

    public function __invoke(CheckMassQuery $query)
    {
        /**@var SpaceResearchStation $researchStation */
        $researchStation = $this->stationRepository->getResarchStationByName('spacestation');

        return $researchStation->getMass();
    }
}