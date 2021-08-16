<?php
declare(strict_types=1);

namespace App\Handler;

use App\DomainModel\Delivery;
use App\Query\CheckDeliveryStatusQuery;
use App\Service\DeliveryRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CheckDeliveryStatusQueryHandler implements MessageHandlerInterface
{
    private DeliveryRepositoryInterface $deliveryRepository;

    public function __construct(DeliveryRepositoryInterface $deliveryRepository)
    {
        $this->deliveryRepository = $deliveryRepository;
    }

    public function __invoke(CheckDeliveryStatusQuery $query): ?Delivery
    {
        return $this->deliveryRepository->getById($query->id);
    }
}
