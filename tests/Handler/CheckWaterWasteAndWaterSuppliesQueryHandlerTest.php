<?php
declare(strict_types=1);

namespace App\Tests\Handler;

use App\DomainModel\SpaceResearchStation;
use App\Handler\CheckWaterWasteAndWaterSuppliesQueryHandler;
use App\Query\CheckWaterWasteAndWaterSuppliesQuery;
use App\Service\ResarchStationRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CheckWaterWasteAndWaterSuppliesQueryHandlerTest extends KernelTestCase
{
    private ResarchStationRepositoryInterface $stationRepository;
    private CheckWaterWasteAndWaterSuppliesQueryHandler $handler;

    protected function setUp(): void
    {
        $this->stationRepository = $this->createMock(ResarchStationRepositoryInterface::class);
    }

    /** @test */
    public function should_return_valid_data()
    {
        $this->stationRepository->method('getResarchStationByName')
            ->willReturn(new SpaceResearchStation(1, 70, 100,
                10000.05, 12, 12.5, 89, 12));

        $this->assertEquals(12.5, $this->handler->__invoke(new CheckWaterWasteAndWaterSuppliesQuery()));
    }
}
