<?php
declare(strict_types=1);

namespace App\Handler;

//TODO tests and event repo
use App\Command\ReportARequestCommand;
use App\DomainModel\SpaceResearchStation;
use App\Event\ReportedARequest;
use App\Service\ResarchStationRepositoryInterface;
use App\Shared\Domain\Event\EventRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class ReportARequestCommandHandler implements MessageHandlerInterface
{
    private EventRepositoryInterface $eventRepository;
    private ResarchStationRepositoryInterface $stationRepository;

    public function __construct(EventRepositoryInterface $eventRepository, ResarchStationRepositoryInterface $stationRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->stationRepository = $stationRepository;
    }

    public function __invoke(ReportARequestCommand $command)
    {
        $researchStation = $this->stationRepository->getResarchStationByName($command->destination);
        $researchStation->askForHelp();

        $this->stationRepository->save($researchStation);
        $this->eventRepository->save(new ReportedARequest($command->destination));
    }
}
