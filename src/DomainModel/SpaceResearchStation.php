<?php

declare(strict_types=1);

namespace App\DomainModel;


use App\Exception\WrongScientistTypeException;

class SpaceResearchStation extends AbstractResearchStation
{
    private float $oxygenPercentage;
    private int $daysAtOrbit;
    private float $mass;
    private float $energyWaste;
    private float $accumulatorsPercentage;
    private float $position;

    function addScientist(AbstractScientist $scientist): void
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

    public function getOxygenPercentage(): float
    {
        return $this->oxygenPercentage;
    }

    public function setOxygenPercentage(float $oxygenPercentage): void
    {
        $this->oxygenPercentage = $oxygenPercentage;
    }

    public function getDaysAtOrbit(): int
    {
        return $this->daysAtOrbit;
    }

    public function setDaysAtOrbit(int $daysAtOrbit): void
    {
        $this->daysAtOrbit = $daysAtOrbit;
    }

    public function getMass(): float
    {
        return $this->mass;
    }

    public function setMass(float $mass): void
    {
        $this->mass = $mass;
    }

    public function getEnergyWaste(): float
    {
        return $this->energyWaste;
    }

    public function setEnergyWaste(float $energyWaste): void
    {
        $this->energyWaste = $energyWaste;
    }

    public function getAccumulatorsPercentage(): float
    {
        return $this->accumulatorsPercentage;
    }

    public function setAccumulatorsPercentage(float $accumulatorsPercentage): void
    {
        $this->accumulatorsPercentage = $accumulatorsPercentage;
    }

    public function getPosition(): float
    {
        return $this->position;
    }

    public function setPosition(float $position): void
    {
        $this->position = $position;
    }
}