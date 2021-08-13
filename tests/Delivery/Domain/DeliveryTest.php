<?php

declare(strict_types=1);

namespace App\Tests\Delivery\Domain;

use App\DomainModel\Delivery;
use App\DomainModel\MarsScientist;
use App\DomainModel\Product;
use PHPUnit\Framework\TestCase;

class DeliveryTest extends TestCase
{
    private Delivery $delivery;

    public function change_delivery_status_to_sent_should_run_successful()
    {
        $this->doesNotPerformAssertions();
        $this->delivery = new Delivery(
            new MarsScientist(1, 'Adam', 'Jensen', '', [], [], []),
            new Product('food'),
            ''
        );

        $this->delivery->changeStatusToSent();
    }

    public function change_delivery_status_to_sent_should_throw_error()
    {
        $this->expectException(CannotChangeStatusOfDeliveredDeliveryException::class);
        $this->delivery = new Delivery(
            new MarsScientist(1, 'Adam', 'Jensen', '', [], [], []),
            new Product('food'),
            'delivered'
        );

        $this->delivery->changeStatusToSent();
    }
}
