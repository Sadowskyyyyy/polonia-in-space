<?php

declare(strict_types=1);

namespace App\Command;

use App\DomainModel\Product;
use App\Shared\Application\Command\CommandInterface;

class SendDeliveryCommand implements CommandInterface
{
    private Product $product;
    private string $destination;

    public function __construct(string $category, string $destination)
    {
        $this->product = new Product($category);
        $this->destination = $destination;
    }
}
