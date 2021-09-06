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

    public function __construct(
        int   $id,
        float $oxygenPercentage,
        int   $daysAtOrbit,
        float $mass,
        float $energyWaste,
        float $waterWaste,
        float $accumulatorsPercentage,
        float $position,
        array $scientists,
        array $products,
        array $events,
        bool  $needHelp
    )
    {
        parent::__construct($id, $scientists, $products, $events, $needHelp);
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
}
