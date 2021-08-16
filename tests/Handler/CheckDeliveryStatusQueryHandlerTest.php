<?php
declare(strict_types=1);

namespace App\Tests\Handler;

use App\DomainModel\Delivery;
use App\DomainModel\Product;
use App\Handler\CheckDeliveryStatusQueryHandler;
use App\Query\CheckDeliveryStatusQuery;
use App\Service\DeliveryRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CheckDeliveryStatusQueryHandlerTest extends KernelTestCase
{
    private DeliveryRepositoryInterface $deliveryRepository;
    private CheckDeliveryStatusQueryHandler $handler;

    protected function setUp(): void
    {
        $this->deliveryRepository = $this->createMock(DeliveryRepositoryInterface::class);
        $this->handler = new CheckDeliveryStatusQueryHandler($this->deliveryRepository);
    }

    /** @test */
    public function should_return_valid_delivery()
    {
        $this->deliveryRepository->method('getById')
            ->willReturn(new Delivery(null, new Product('food'), 'delivered'));

        $this->assertSame(new Delivery(null, new Product('food'), 'delivered'),
            $this->handler->__invoke(new CheckDeliveryStatusQuery(1, 'any')));
    }

    /** @test */
    public function should_return_null_object()
    {
        $this->deliveryRepository->method('getById')
            ->willReturn(null);

        $this->assertSame(null, $this->handler->__invoke(new CheckDeliveryStatusQuery(1, 'any')));
    }
}
