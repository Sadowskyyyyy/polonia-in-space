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
    private float $waterWaste;
    private float $accumulatorsPercentage;
    private float $position;

    public function __construct(int   $id,
                                float $oxygenPercentage,
                                int   $daysAtOrbit,
                                float $mass,
                                float $energyWaste,
                                float $waterWaste,
                                float $accumulatorsPercentage,
                                float $position)
    {
        parent::__construct($id);
        $this->oxygenPercentage = $oxygenPercentage;
        $this->daysAtOrbit = $daysAtOrbit;
        $this->mass = $mass;
        $this->energyWaste = $energyWaste;
        $this->waterWaste = $waterWaste;
        $this->accumulatorsPercentage = $accumulatorsPercentage;
        $this->position = $position;
    }


    public function addScientist(AbstractScientist $scientist): void
    {
        if (!$scientist instanceof SpaceScientist) {
            throw new WrongScientistTypeException();
        }

        $this->scientists[] = $scientist;
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

    public function getWaterWaste(): float
    {
        return $this->waterWaste;
    }

    public function setWaterWaste(float $waterWaste): void
    {
        $this->waterWaste = $waterWaste;
    }
}
