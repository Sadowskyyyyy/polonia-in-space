<?php

namespace App\Application\Delivery\Domain;

use App\Application\Delivery\Domain\Exception\CannotChangeStatusOfDeliveredDeliveryException;
use App\Application\Product\Domain\Product;
use App\Application\Scientist\Domain\AbstractScientist;

class Delivery
{
    private AbstractScientist $sender;
    private Product $product;
    private string $status;
    private string $postDate;
    private string $pickUpAddress;

    public function __construct(AbstractScientist $sender, Product $product, string $status, string $postDate, string $pickUpAddress)
    {
        $this->sender = $sender;
        $this->product = $product;
        $this->status = $status;
        $this->postDate = $postDate;
        $this->pickUpAddress = $pickUpAddress;
    }

    public function changeStatusToDelivered(): void
    {
        $this->status = 'delivered';
    }

    public function changeStatusToSent(): void
    {
        if ('delivered' === $this->status) {
            throw new CannotChangeStatusOfDeliveredDeliveryException();
        }

        $this->status = 'sent';
    }

    public function getSender(): AbstractScientist
    {
        return $this->sender;
    }
}
