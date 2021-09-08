<?php
declare(strict_types=1);

namespace App\Tests\Delivery\Domain;

use App\DomainModel\Delivery;
use App\DomainModel\EarthScientistDomain;
use App\DomainModel\Product;
use App\Exception\CannotChangeStatusOfDeliveredDeliveryException;
use PHPUnit\Framework\TestCase;

class DeliveryTest extends TestCase
{
    private Delivery $delivery;

    protected function setUp(): void
    {
        $this->delivery = Delivery::createNewDelivery(
            sender: new EarthScientistDomain('Adam', 'Adam', 'Jensen', []),
            product: new Product('food'),
            destination: 'spacestation',
            status: '',
            postDate: new \DateTime(),
            pickUpDate: (new \DateTime())->modify('+14 minutes')
        );
    }

    /** @test */
    public function test_should_change_delivery_status_to_sent_should_run_successful(): void
    {
        $this->delivery->changeStatusToSent();

        $this->assertEquals('sent', $this->delivery->getStatus());
    }

    /** @test */
    public function test_change_delivery_status_to_sent_should_throw_error(): void
    {
        $this->expectException(CannotChangeStatusOfDeliveredDeliveryException::class);
        $this->delivery->changeStatusToDelivered();

        $this->delivery->changeStatusToSent();
    }
}