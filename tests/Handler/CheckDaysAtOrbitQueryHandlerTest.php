<?php
declare(strict_types=1);

namespace App\Tests\Handler;

use App\DomainModel\SpaceResearchStation;
use App\Handler\CheckDaysAtOrbitQueryHandler;
use App\Query\CheckDaysAtOrbitQuery;
use App\Service\ResarchStationRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CheckDaysAtOrbitQueryHandlerTest extends KernelTestCase
{
    private ResarchStationRepositoryInterface $stationRepository;
    private CheckDaysAtOrbitQueryHandler $handler;

    protected function setUp(): void
    {
        $this->stationRepository = $this->createMock(ResarchStationRepositoryInterface::class);
        $this->handler = new CheckDaysAtOrbitQueryHandler($this->stationRepository);
    }

    /** @test */
    public function should_return_days_at_orbit_number()
    {
        $this->stationRepository->method('getResarchStationByName')
            ->willReturn(new SpaceResearchStation(
                1, 70, 100, 10000.05,
                12, 12.5, 89, 12));

        $this->assertEquals(100, $this->handler->__invoke(new CheckDaysAtOrbitQuery()));
    }
}
