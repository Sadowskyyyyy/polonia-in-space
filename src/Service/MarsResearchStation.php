<?php

declare(strict_types=1);

namespace App\Service;

use App\DomainModel\AbstractResearchStation;
use App\DomainModel\AbstractScientist;
use App\DomainModel\MarsScientist;
use App\Exception\WrongScientistTypeException;

class MarsResearchStation extends AbstractResearchStation
{
    public function __construct(int $id){
        parent::__construct($id);
    }

    public function addScientist(AbstractScientist $scientist): void
    {
        if (!$scientist instanceof MarsScientist) {
            throw new WrongScientistTypeException();
        }

        $this->getScientists()[$scientist->getId()] = $scientist;
    }
}
