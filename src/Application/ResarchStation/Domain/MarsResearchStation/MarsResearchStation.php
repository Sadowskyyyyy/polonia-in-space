<?php

declare(strict_types=1);

namespace App\Application\ResarchStation\Domain\MarsResearchStation;

use App\Application\ResarchStation\Domain\AbstractResearchStation;
use App\Application\ResarchStation\Domain\Exception\WrongScientistTypeException;
use App\Application\Scientist\Domain\AbstractScientist;
use App\Application\Scientist\Domain\MarsScientist\MarsScientist;

class MarsResearchStation extends AbstractResearchStation
{
    public function addScientist(AbstractScientist $scientist): void
    {
        if (!$scientist instanceof MarsScientist) {
            throw new WrongScientistTypeException();
        }

        $this->getScientists()[$scientist->getId()] = $scientist;
    }
}
