<?php
declare(strict_types=1);

namespace App\Tests\ResarchStation\Domain\MarsResearchStation;

use App\DomainModel\EarthScientistDomain;
use App\DomainModel\MarsResearchStation;
use App\DomainModel\MarsScientist;
use App\Exception\WrongScientistTypeException;
use PHPUnit\Framework\TestCase;
use function count;

class MarsResearchStationTest extends TestCase
{
    private MarsResearchStation $marsResearchStation;

    /** @test */
    public function test_try_to_add_other_instance_of_scientist_then_throw_error(): void
    {
        $this->expectException(WrongScientistTypeException::class);

        $this->marsResearchStation = new MarsResearchStation(1, [], [], [], false);
        $this->marsResearchStation->addScientist(
            new EarthScientistDomain('Adam', 'Jensen', '123', [])
        );
    }

    /**
     * @test
     */
    public function test_try_to_add_scientist_then_run_successful(): void
    {
        $this->marsResearchStation = new MarsResearchStation(1, [], [], [], false);
        $this->marsResearchStation
            ->addScientist(new MarsScientist('Adam', 'Jensen', '1234', [], [], []));

        $this->assertEquals(1, count($this->marsResearchStation->getScientists()));
    }
}
