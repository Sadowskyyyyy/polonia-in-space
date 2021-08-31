<?php
declare(strict_types=1);

namespace App\DomainModel;

use App\Entity\EarthResearchStation;
use App\Entity\EarthScientist;

class EarthScientistDomain extends AbstractScientist
{
    public function __construct(string $name, string $surname, string $apikey, array $deliveries)
    {
        parent::__construct($name, $surname, $apikey);
        $this->setSentDeliveries($deliveries);
    }

    public static function toEntity(
        self $earthScientist,
        EarthResearchStation $earthResearchStationEntity
    ): EarthScientist {
        return new EarthScientist(
            $earthScientist->id,
            $earthScientist->name,
            $earthScientist->surname,
            $earthScientist->apikey,
            $earthResearchStationEntity
        );
    }
}
