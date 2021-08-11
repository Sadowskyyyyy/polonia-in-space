<?php

declare(strict_types=1);

namespace App\Application\ResarchStation\Application\Handler;

use App\Application\ResarchStation\Application\Command\ChangeAngleCommand;
use App\Application\ResarchStation\Application\Event\ChangedAngle;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
//TODO tests and repository
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