<?php
declare(strict_types=1);

namespace App\Tests\ResarchStation\Domain\EarthResarchStation;

use App\DomainModel\EarthResearchStation;
use App\DomainModel\EarthScientistDomain;
use App\DomainModel\SpaceScientist;
use App\Exception\WrongScientistTypeException;
use PHPUnit\Framework\TestCase;
use function count;

class EarthResearchStationTest extends TestCase
{
    private EarthResearchStation $researchStation;

    protected function setUp(): void
    {
        $this->researchStation = new EarthResearchStation(
            id: 1,
            scientists: [],
            products: [],
            events: [],
            needHelp: false
        );
    }

    /** @test */
    public function test_try_to_add_other_instance_of_scientist_then_throw_error(): void
    {
        $this->expectException(WrongScientistTypeException::class);

        $this->researchStation->addScientist(new SpaceScientist('Adam', 'Jensen', '1234', []));
    }

    /** @test */
    public function test_try_to_add_scientist_then_run_successful(): void
    {
        $this->researchStation
            ->addScientist(new EarthScientistDomain('Adam', 'Jensen', '1234', []));

        $this->assertEquals(1, count($this->researchStation->getScientists()));
    }
}
