<?php
declare(strict_types=1);

namespace App\Service;

use App\DomainModel\Delivery;

interface DeliveryRepositoryInterface
{
    public function getById(int $id): ?Delivery;
}
