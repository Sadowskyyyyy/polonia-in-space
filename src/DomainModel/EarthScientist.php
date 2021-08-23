<?php
declare(strict_types=1);

namespace App\DomainModel;

use App\Entity\EarthResarchStation;
use App\Entity\EarthScientistEntity;

class EarthScientist extends AbstractScientist
{
    public static function toEntity(EarthScientist $earthScientist)
    {
        return new EarthScientistEntity($earthScientist->getName(),
        $earthScientist->getSurname(),
        $earthScientist->getPassword(),
        $earthScientist->getPassword(),
        null
        );
    }
}
