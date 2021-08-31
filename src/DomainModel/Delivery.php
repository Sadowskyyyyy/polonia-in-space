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
    private \DateTime $postDate;
    private \DateTime $pickUpDate;

    public function __construct(
        AbstractScientist $sender,
        Product $product,
        string $destination,
        string $status
    )
    {
        $this->sender = $sender;
        $this->product = $product;
        $this->destination = $destination;
        $this->status = $status;
        $this->postDate = new \DateTime();
        $this->pickUpDate = $this->postDate->modify('+14 minutes');
    }

    public static function createNewDelivery(
        AbstractScientist $sender,
        Product $product,
        string $destination,
        string $status
    ): self
    {
        return new self($sender, $product, $destination, $status);
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
