<?php

declare(strict_types=1);

namespace App\Tests\Application\ResarchStation\Domain\SpaceResearchStation;

use App\Application\ResarchStation\Domain\Exception\WrongScientistTypeException;
use App\Application\ResarchStation\Domain\SpaceResearchStation\SpaceResearchStation;
use App\Application\Scientist\Domain\EarthScientist\EarthScientist;
use App\Application\Scientist\Domain\SpaceScientist\SpaceScientist;
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

    /**
     * @doesNotPerformAssertions
     */
    public function testTryToAddScientistThenRunSuccessful()
    {
        $this->doesNotPerformAssertions();

        $this->researchStation = new SpaceResearchStation(1);
        $this->researchStation
            ->addScientist(new SpaceScientist(1, 'Adam', 'Jensen', ''));
    }

}