<?php
declare(strict_types=1);

namespace App\DomainModel;

class Product
{
    private string $category;

    public function __construct(string $category)
    {
        $this->category = $category;
    }
}
