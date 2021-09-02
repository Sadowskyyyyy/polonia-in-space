<?php

declare(strict_types=1);

namespace App\Tests\ResarchStation\Domain\SpaceResearchStation;

use App\DomainModel\EarthScientistDomain;
use App\DomainModel\SpaceResearchStation;
use App\DomainModel\SpaceScientist;
use App\Exception\WrongScientistTypeException;
use PHPUnit\Framework\TestCase;
use function count;

class SpaceResearchStationTest extends TestCase
{
    private SpaceResearchStation $researchStation;

    protected function setUp(): void
    {
        $this->researchStation = new SpaceResearchStation(
            id: 1,
            oxygenPercentage: 70,
            daysAtOrbit: 100,
            mass: 10000.05,
            energyWaste: 12,
            waterWaste: 12.5,
            accumulatorsPercentage: 89,
            position: 12,
            scientists: [],
            products: [],
            events: [],
            needHelp: false
        );
    }

    /** @test */
    public function try_to_add_wrong_scientist_type_should_throw_error(): void
    {
        $this->expectException(WrongScientistTypeException::class);

        $this->researchStation->addScientist(new EarthScientistDomain('Adam', 'jensen', '1234', []));
    }

    /** @test */
    public function try_to_add_scientist_should_run_successful(): void
    {
        $newScientist = new SpaceScientist('Adam', 'Jensen', '1234', []);
        $this->researchStation->addScientist($newScientist);

        $this->assertEquals(1, count($this->researchStation->getScientists()));
    }
}
