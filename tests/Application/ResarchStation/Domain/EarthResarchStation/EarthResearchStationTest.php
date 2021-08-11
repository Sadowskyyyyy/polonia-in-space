<?php

declare(strict_types=1);

namespace App\Tests\Application\ResarchStation\Domain\EarthResarchStation;

use App\Application\ResarchStation\Domain\EarthResearchStation\EarthResearchStation;
use App\Application\ResarchStation\Domain\Exception\WrongScientistTypeException;
use App\Application\Scientist\Domain\EarthScientist\EarthScientist;
use App\Application\Scientist\Domain\SpaceScientist\SpaceScientist;
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