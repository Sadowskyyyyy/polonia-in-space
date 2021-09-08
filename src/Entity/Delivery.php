<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Delivery
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public ?int $id;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="delivery")
     */
    public Collection $products;

    /**
     * @ORM\Column(type="string", length=20)
     */
    public string $destination;

    /**
     * @ORM\Column(type="string", length=15)
     */
    public string $status;

    /**
     * @ORM\Column(type="date")
     */
    public \DateTimeInterface $postDate;

    /**
     * @ORM\Column(type="date")
     */
    public \DateTimeInterface $pickUpDate;

    public function __construct(Collection $products, string $destination, string $status, \DateTimeInterface $postDate, \DateTimeInterface $pickUpDate)
    {
        $this->products = $products;
        $this->destination = $destination;
        $this->status = $status;
        $this->postDate = $postDate;
        $this->pickUpDate = $pickUpDate;
    }
}
