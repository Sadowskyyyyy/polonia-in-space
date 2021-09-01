<?php
declare(strict_types=1);

namespace App\DomainModel;

use App\Entity\EarthResearchStation;
use App\Entity\EarthScientist;
use App\Entity\User;

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
            $earthScientist->name,
            $earthScientist->surname,
            $earthResearchStationEntity,
            new User($earthScientist->name, ['ROLE_EARTH_SCIENTIST'], $earthScientist->apikey),
            $earthScientist->apikey
        );
    }
}
