<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public int $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    public string $category;

    /**
     * @ORM\ManyToOne(targetEntity=Delivery::class, inversedBy="product")
     * @ORM\JoinColumn(nullable=false)
     */
    public Delivery $delivery;

    public function __construct(string $category, Delivery $delivery)
    {
        $this->category = $category;
        $this->delivery = $delivery;
    }
}
