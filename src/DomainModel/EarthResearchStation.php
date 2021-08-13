<?php

declare(strict_types=1);

namespace App\DomainModel;


use App\Exception\WrongScientistTypeException;

class EarthResearchStation extends AbstractResearchStation
{
    function addScientist(AbstractScientist $scientist): void
    {
        if (!$scientist instanceof EarthScientist) {
            throw new WrongScientistTypeException();
        }

        $this->getScientists()[$scientist->getId()] = $scientist;
    }
}