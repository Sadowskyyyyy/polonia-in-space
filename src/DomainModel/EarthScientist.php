<?php
declare(strict_types=1);

namespace App\DomainModel;

use App\Entity\EarthResarchStation;
use App\Entity\EarthScientistEntity;

class EarthScientist extends AbstractScientist
{
    public function __construct(int $id, string $name, string $surname, string $apikey, array $deliveries)
    {
        parent::__construct($id, $name, $surname, $apikey);
        $this->setSentDeliveries($deliveries);
    }

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
