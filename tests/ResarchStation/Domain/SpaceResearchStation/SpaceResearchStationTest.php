<?php

declare(strict_types=1);

namespace App\Tests\ResarchStation\Domain\SpaceResearchStation;

use App\DomainModel\EarthScientist;
use App\DomainModel\SpaceResearchStation;
use App\DomainModel\SpaceScientist;
use App\Exception\WrongScientistTypeException;
use PHPUnit\Framework\TestCase;

class SpaceResearchStationTest extends TestCase
{
    private SpaceResearchStation $researchStation;

    public function try_to_add_wrong_scientist_type_should_throw_error()
    {
        $this->expectException(WrongScientistTypeException::class);

        $this->researchStation = new SpaceResearchStation(1, 70, 100,
            10000.05, 12, 12.5, 89, 12);

        $this->researchStation->addScientist(new EarthScientist(1, 'Adam', 'Jensen', ''));
    }

    public function try_to_add_scientist_should_run_successful()
    {
        $newScientist = new SpaceScientist(1, 'Adam', 'Jensen', '');

        $this->researchStation = new SpaceResearchStation(1, 70, 100,
            10000.05, 12, 12.5, 89, 12);
        $this->researchStation->addScientist($newScientist);

        $this->assertEquals($newScientist, $this->researchStation->getScientists()[0]);
    }
}
