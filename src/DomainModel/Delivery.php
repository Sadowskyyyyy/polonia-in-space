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
    private \DateTimeInterface $postDate;
    private \DateTimeInterface $pickUpDate;

    public function __construct(
        AbstractScientist  $sender,
        Product            $product,
        string             $destination,
        string             $status,
        \DateTimeInterface $postDate,
        \DateTimeInterface $pickUpDate
    )
    {
        $this->sender = $sender;
        $this->product = $product;
        $this->destination = $destination;
        $this->status = $status;
        $this->postDate = $postDate;
        $this->pickUpDate = $pickUpDate;
    }

    public static function createNewDelivery(
        AbstractScientist  $sender,
        Product            $product,
        string             $destination,
        string             $status,
        \DateTimeInterface $postDate,
        \DateTimeInterface $pickUpDate
    ): self
    {
        return new self($sender, $product, $destination, $status, $postDate, $pickUpDate);
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

    public function getStatus(): string
    {
        return $this->status;
    }
}
