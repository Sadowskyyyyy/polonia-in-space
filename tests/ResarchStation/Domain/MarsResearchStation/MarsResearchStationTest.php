<?php

namespace App\Tests\ResarchStation\Domain\MarsResearchStation;

use App\DomainModel\EarthScientist;
use App\DomainModel\MarsResearchStation;
use App\DomainModel\MarsScientist;
use App\Exception\WrongScientistTypeException;
use PHPUnit\Framework\TestCase;
use function count;

class MarsResearchStationTest extends TestCase
{
    private MarsResearchStation $marsResearchStation;

    /** @test */
    public function test_try_to_add_other_instance_of_scientist_then_throw_error()
    {
        $this->expectException(WrongScientistTypeException::class);

        $this->marsResearchStation = new MarsResearchStation(1);
        $this->marsResearchStation->addScientist(new EarthScientist(1, 'Adam', 'Jensen', ''));
    }

    /** @test */
    public function test_try_to_add_scientist_then_run_successful()
    {
        $this->doesNotPerformAssertions();

        $this->marsResearchStation = new MarsResearchStation(1);
        $this->marsResearchStation
            ->addScientist(new MarsScientist(1, 'Adam', 'Jensen', '', [], [], []));

        $this->assertEquals(1, count($this->marsResearchStation->getScientists()));
    }
}
