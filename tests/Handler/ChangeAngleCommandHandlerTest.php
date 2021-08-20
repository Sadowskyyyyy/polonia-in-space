<?php
declare(strict_types=1);

namespace App\Tests\Handler;

use App\Command\ChangeAngleCommand;
use App\DomainModel\SpaceResearchStation;
use App\Handler\ChangeAngleCommandHandler;
use App\Service\ResarchStationRepositoryInterface;
use App\Shared\Domain\Event\EventRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ChangeAngleCommandHandlerTest extends KernelTestCase
{
    private ChangeAngleCommandHandler $handler;
    private ResarchStationRepositoryInterface $stationRepository;
    private EventRepositoryInterface $eventRepository;

    protected function setUp(): void
    {
        $this->stationRepository = $this->createMock(ResarchStationRepositoryInterface::class);
        $this->eventRepository = $this->createMock(EventRepositoryInterface::class);
        $this->handler = new ChangeAngleCommandHandler($this->stationRepository, $this->eventRepository);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function given_valid_data_to_change_position()
    {
        $this->stationRepository->method('getResarchStationByName')
            ->willReturn(
                new SpaceResearchStation(1, 70, 100,
                    10000.05, 12, 12.5,
                    89, 12)
            );

        $this->handler->__invoke(new ChangeAngleCommand(12));
    }
}
