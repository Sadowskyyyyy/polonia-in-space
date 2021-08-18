<?php
declare(strict_types=1);

namespace App\DomainModel;

use App\Exception\CannotChangeStatusOfDeliveredDeliveryException;

class Delivery
{
    private AbstractScientist $sender;
    private Product $product;
    private string $destination;
    private string $status;
    private float $postDate;
    private float $pickUpDate;

    public function __construct(AbstractScientist $sender,
                                Product           $product,
                                string            $destination,
                                string            $status,
                                float             $postDate,
                                float             $pickUpAddress)
    {
        $this->sender = $sender;
        $this->product = $product;
        $this->destination = $destination;
        $this->status = $status;
        $this->postDate = $postDate;
        $this->pickUpDate = $pickUpAddress;
    }

    public static function createNewDelivery(
        AbstractScientist $sender,
        Product           $product,
        string            $destination,
        string            $status): Delivery
    {
        $now = new \DateTime();
        $now = $now->getTimestamp();
        $pickupDate = $now + (14 * 60 * 1000);

        return new Delivery($sender, $product, $destination, $status, $now, $pickupDate);
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

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getDestination(): string
    {
        return $this->destination;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getPostDate(): \DateTime
    {
        return $this->postDate;
    }

    public function getPickUpDate(): \DateTime
    {
        return $this->pickUpDate;
    }
}
