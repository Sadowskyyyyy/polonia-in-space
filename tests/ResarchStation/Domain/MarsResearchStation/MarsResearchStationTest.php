<?php

namespace App\Tests\ResarchStation\Domain\MarsResearchStation;


use App\DomainModel\EarthScientist;
use App\DomainModel\MarsScientist;
use App\Exception\WrongScientistTypeException;
use App\Service\MarsResearchStation;
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