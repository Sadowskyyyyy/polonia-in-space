<?php

declare(strict_types=1);

namespace App\Tests\ResarchStation\Domain\EarthResarchStation;

use App\DomainModel\EarthResearchStation;
use App\DomainModel\EarthScientist;
use App\DomainModel\SpaceScientist;
use App\Exception\WrongScientistTypeException;
use PHPUnit\Framework\TestCase;

class EarthResearchStationTest extends TestCase
{
    private EarthResearchStation $researchStation;

    public function testTryToAddOtherInstanceOfScientistThenThrowError()
    {
        $this->expectException(WrongScientistTypeException::class);

        $this->researchStation = new EarthResearchStation(1);
        $this->researchStation->addScientist(new SpaceScientist(1, 'Adam', 'Jensen', ''));
    }

    public function testTryToAddScientistThenRunSuccessful()
    {
        $this->doesNotPerformAssertions();

        $this->researchStation = new EarthResearchStation(1);
        $this->researchStation
            ->addScientist(new EarthScientist(1, 'Adam', 'Jensen', ''));
    }
}
