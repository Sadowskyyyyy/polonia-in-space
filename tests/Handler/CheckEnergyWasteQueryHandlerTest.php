<?php
declare(strict_types=1);

namespace App\Tests\Handler;

use App\DomainModel\SpaceResearchStation;
use App\Handler\CheckEnergyWasteQueryHandler;
use App\Query\CheckDaysAtOrbitQuery;
use App\Query\CheckEnergyWasteQuery;
use App\Service\ResarchStationRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CheckEnergyWasteQueryHandlerTest extends KernelTestCase
{
    private ResarchStationRepositoryInterface $stationRepository;
    private CheckEnergyWasteQueryHandler $handler;

    protected function setUp(): void
    {
        $this->stationRepository = $this->createMock(ResarchStationRepositoryInterface::class);
        $this->handler = new CheckEnergyWasteQueryHandler($this->stationRepository);
    }

    /** @test */
    public function should_return_valid_data()
    {
        $this->stationRepository->method('getResarchStationByName')
            ->willReturn(new SpaceResearchStation(1, 70, 100,
                10000.05, 12, 12.5, 89, 12));

        $this->assertSame(12,
            $this->handler->__invoke(new CheckEnergyWasteQuery()));
    }
}
