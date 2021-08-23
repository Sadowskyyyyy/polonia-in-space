<?php

declare(strict_types=1);

namespace App\Application\ResarchStation\Domain\SpaceResearchStation;

use App\Application\ResarchStation\Domain\AbstractResearchStation;
use App\Application\ResarchStation\Domain\Exception\WrongScientistTypeException;
use App\Application\Scientist\Domain\AbstractScientist;
use App\Application\Scientist\Domain\SpaceScientist\SpaceScientist;

class SpaceResearchStation extends AbstractResearchStation
{
    private float $oxygenPercentage;
    private int $daysAtOrbit;
    private float $mass;
    private float $energyWaste;
    private float $accumulatorsPercentage;
    private float $position;

    public function addScientist(AbstractScientist $scientist): void
    {
        if (!$scientist instanceof SpaceScientist) {
            throw new WrongScientistTypeException();
        }

        $this->getScientists()[$scientist->getId()] = $scientist;
    }

    public function changePosition(float $degrees)
    {
        $this->position = $this->position += $degrees;
    }
}
