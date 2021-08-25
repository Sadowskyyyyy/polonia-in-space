<?php
declare(strict_types=1);

namespace App\DomainModel;

use App\Entity\EarthResarchStation;
use App\Entity\EarthScientistEntity;

class EarthScientist extends AbstractScientist
{
    public function __construct(int $id, string $name, string $surname, string $password)
    {
        parent::__construct($id, $name, $surname, $password);
    }
}
