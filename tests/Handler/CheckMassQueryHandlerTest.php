<?php
declare(strict_types=1);

namespace App\Tests\Handler;

use App\DomainModel\SpaceResearchStation;
use App\Handler\CheckMassQueryHandler;
use App\Service\ResarchStationRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Query\CheckMassQuery;

class CheckMassQueryHandlerTest extends KernelTestCase
{
    private ResarchStationRepositoryInterface $stationRepository;
    private CheckMassQueryHandler $handler;

    protected function setUp(): void
    {
        $this->stationRepository = $this->createMock(ResarchStationRepositoryInterface::class);
        $this->handler = new CheckMassQueryHandler($this->stationRepository);
    }

    /** @test */
    public function should_return_valid_data()
    {
        $this->stationRepository->method('getResarchStationByName')
            ->willReturn(new SpaceResearchStation(1, 70, 100,
                10000.05, 12, 12.5, 89, 12));

        $this->assertEquals(10000.05, $this->handler->__invoke(new CheckMassQuery()));
    }
}
