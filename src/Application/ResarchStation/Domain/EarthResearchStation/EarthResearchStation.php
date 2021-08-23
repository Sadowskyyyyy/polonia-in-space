<?php

declare(strict_types=1);

namespace App\Application\ResarchStation\Domain\EarthResearchStation;

use App\Application\ResarchStation\Domain\AbstractResearchStation;
use App\Application\ResarchStation\Domain\Exception\WrongScientistTypeException;
use App\Application\Scientist\Domain\AbstractScientist;
use App\Application\Scientist\Domain\EarthScientist\EarthScientist;

class EarthResearchStation extends AbstractResearchStation
{
    public function addScientist(AbstractScientist $scientist): void
    {
        if (!$scientist instanceof EarthScientist) {
            throw new WrongScientistTypeException();
        }

        $this->getScientists()[$scientist->getId()] = $scientist;
    }
}
