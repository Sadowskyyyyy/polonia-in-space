<?php

declare(strict_types=1);

namespace App\Tests\ResarchStation\Domain\SpaceResearchStation;

use App\DomainModel\EarthScientist;
use App\DomainModel\EarthScientistDomain;
use App\DomainModel\SpaceResearchStation;
use App\DomainModel\SpaceScientist;
use App\Exception\WrongScientistTypeException;
use PHPUnit\Framework\TestCase;
use function count;

class SpaceResearchStationTest extends TestCase
{
    private SpaceResearchStation $researchStation;

    /** @test */
    public function try_to_add_wrong_scientist_type_should_throw_error()
    {
        $this->expectException(WrongScientistTypeException::class);

        $this->researchStation = new SpaceResearchStation(1, 70, 100,
            10000.05, 12, 12.5, 89, 12);

        $this->researchStation->addScientist(new EarthScientistDomain('Adam', 'jensen', '1234', []));
    }

    /** @test */
    public function try_to_add_scientist_should_run_successful()
    {
        $newScientist = new SpaceScientist('Adam', 'Jensen', '1234', []);

        $this->researchStation = new SpaceResearchStation(1, 70, 100,
            10000.05, 12, 12.5, 89, 12);

        $this->researchStation->addScientist($newScientist);
        $this->assertEquals(1, count($this->researchStation->getScientists()));
    }
}
