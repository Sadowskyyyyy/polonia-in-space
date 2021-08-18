<?php
declare(strict_types=1);

namespace App\DomainModel;

class SpaceScientist extends AbstractScientist
{
    public function __construct(int $id, string $name, string $surname, string $password, array $deliveries)
    {
        parent::__construct($id, $name, $surname, $password);
        $this->setSentDeliveries($deliveries);
    }
}
