<?php

declare(strict_types=1);

namespace App\Handler;


//TODO tests and repository
use App\Command\ChangeAngleCommand;
use App\Event\ChangedAngle;
class ChangeAngleCommandHandler implements MessageHandlerInterface
{
    private ResarchStationRepositoryInterface $stationRepository;

    private EventRepositoryInterface $eventRepository;

    public function __construct(ResarchStationRepositoryInterface $stationRepository)
    {
        $this->stationRepository = $stationRepository;
    }

    public function __invoke(ChangeAngleCommand $command)
    {
        $this->eventRepository->save(new ChangedAngle());
    }
}