<?php
declare(strict_types=1);

namespace App\DomainModel;

use App\Exception\WrongScientistTypeException;

class EarthResearchStation extends AbstractResearchStation
{
    public function addScientist(AbstractScientist $scientist): void
    {
        if (!$scientist instanceof EarthScientist) {
            throw new WrongScientistTypeException();
        }

        $this->scientists[$scientist->getId()] = $scientist;
    }
}
