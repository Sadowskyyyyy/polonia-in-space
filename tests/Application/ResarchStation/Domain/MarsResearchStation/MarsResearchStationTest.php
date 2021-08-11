<?php

namespace App\Tests\Application\ResarchStation\Domain\MarsResearchStation;

use App\Application\ResarchStation\Domain\Exception\WrongScientistTypeException;
use App\Application\ResarchStation\Domain\MarsResearchStation\MarsResearchStation;
use App\Application\Scientist\Domain\EarthScientist\EarthScientist;
use App\Application\Scientist\Domain\MarsScientist\MarsScientist;
use PHPUnit\Framework\TestCase;

class MarsResearchStationTest extends TestCase
{
    private MarsResearchStation $marsResearchStation;

    public function testTryToAddOtherInstanceOfScientistThenThrowError()
    {
        $this->expectException(WrongScientistTypeException::class);

        $this->marsResearchStation = new MarsResearchStation(1);
        $this->marsResearchStation->addScientist(new EarthScientist(1, 'Adam', 'Jensen', ''));
    }

    public function testTryToAddScientistThenRunSuccessful()
    {
        $this->doesNotPerformAssertions();

        $this->marsResearchStation = new MarsResearchStation(1);
        $this->marsResearchStation
            ->addScientist(new MarsScientist(1, 'Adam', 'Jensen', '', [], [], []));
    }
}