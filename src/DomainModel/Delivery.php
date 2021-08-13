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
    private string $postDate;
    private string $pickUpAddress;

    public function __construct(AbstractScientist $sender, Product $product, string $status)
    {
        $this->sender = $sender;
        $this->product = $product;
        $this->status = $status;
        $this->postDate = date('Y-m-d H:i:s');
        $this->pickUpAddress = $this->setPickUpAddress();
    }

    private function setPickUpAddress(): string
    {
        return date(
            'Y-m-d H:i:s',
            strtotime(
                date('Y-m-d H:i:s', $this->postDate) . strtotime('now')
            )
        );
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
