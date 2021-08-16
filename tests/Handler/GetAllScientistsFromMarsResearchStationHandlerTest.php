<?php
declare(strict_types=1);

namespace App\Tests\Handler;

use App\DomainModel\MarsScientist;
use App\Handler\GetAllScientistsFromMarsResearchStationHandler;
use App\Query\GetAllScientistsFromMarsResearchStationQuery;
use App\Service\MarsScientistRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GetAllScientistsFromMarsResearchStationHandlerTest extends KernelTestCase
{
    private GetAllScientistsFromMarsResearchStationHandler $handler;
    private MarsScientistRepositoryInterface $marsScientistRepository;

    protected function setUp(): void
    {
        $this->marsScientistRepository = $this->createMock(MarsScientistRepositoryInterface::class);
        $this->handler = new GetAllScientistsFromMarsResearchStationHandler($this->marsScientistRepository);
    }

    /** @test */
    public function should_return_all_scientists_from_station()
    {
        $array = [new MarsScientist(1, 'Adam', 'Jensen', 'pass', [], [], [])];
        $this->marsScientistRepository->method('getAll')
            ->willReturn($array);

        $this->assertEquals($array, $this->handler->__invoke(new GetAllScientistsFromMarsResearchStationQuery()));
    }
}
