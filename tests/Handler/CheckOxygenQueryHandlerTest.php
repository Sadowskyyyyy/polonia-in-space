<?php
declare(strict_types=1);

namespace App\Tests\Handler;

use App\DomainModel\SpaceResearchStation;
use App\Handler\CheckOxygenQueryHandler;
use App\Query\CheckOxygenQuery;
use App\Service\ResarchStationRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CheckOxygenQueryHandlerTest extends KernelTestCase
{
    private ResarchStationRepository $stationRepository;
    private CheckOxygenQueryHandler $handler;

    protected function setUp(): void
    {
        $this->stationRepository = $this->createMock(ResarchStationRepository::class);
        $this->handler = new CheckOxygenQueryHandler($this->stationRepository);
    }

    /** @test */
    public function should_return_valid_data()
    {
        $this->stationRepository->method('getResarchStationByName')
            ->willReturn(new SpaceResearchStation(1, 70, 100,
                10000.05, 12, 12.5, 89, 12));

        $this->assertEquals(70, $this->handler->__invoke(new CheckOxygenQuery()));
    }
}
