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

    public function testTryToAddOtherInstanceOfScientistThenThrowError()
    {
        $this->expectException(WrongScientistTypeException::class);

        $this->researchStation = new SpaceResearchStation(1);
        $this->researchStation->addScientist(new EarthScientist(1, 'Adam', 'Jensen', ''));
    }

    public function testTryToAddScientistThenRunSuccessful()
    {
        $this->doesNotPerformAssertions();

        $this->researchStation = new SpaceResearchStation(1);
        $this->researchStation
            ->addScientist(new SpaceScientist(1, 'Adam', 'Jensen', ''));
    }

}