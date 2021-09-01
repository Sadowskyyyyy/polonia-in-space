<?php
declare(strict_types=1);

namespace App\DomainModel;

class SpaceScientist extends AbstractScientist
{
    public function __construct(string $name, string $surname, string $apikey, array $deliveries)
    {
        parent::__construct($name, $surname, $apikey);
        $this->setSentDeliveries($deliveries);
    }
}
