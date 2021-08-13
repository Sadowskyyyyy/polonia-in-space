<?php
declare(strict_types=1);

namespace App\Handler;

use App\Command\ChangeAngleCommand;
use App\DomainModel\SpaceResearchStation;
use App\Event\ChangedAngle;
use App\Service\ResarchStationRepositoryInterface;
use App\Shared\Domain\Event\EventRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class ChangeAngleCommandHandler implements MessageHandlerInterface
{
    private ResarchStationRepositoryInterface $stationRepository;

    private EventRepositoryInterface $eventRepository;

    public function __construct(ResarchStationRepositoryInterface $stationRepository, EventRepositoryInterface $eventRepository)
    {
        $this->stationRepository = $stationRepository;
        $this->eventRepository = $eventRepository;
    }


    public function __invoke(ChangeAngleCommand $command)
    {
        /**@var SpaceResearchStation $researchStation */
        $researchStation = $this->stationRepository->getResarchStationByName('spacestation');
        $researchStation->changePosition($command->degrees);

        $this->stationRepository->save($researchStation);
        $this->eventRepository->save(new ChangedAngle());
    }
}
