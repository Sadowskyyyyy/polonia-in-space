<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\DeliveryRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DeliveryRepository::class)
 */
class Delivery
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="delivery")
     */
    private Collection $products;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private string $destination;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private string $status;

    /**
     * @ORM\Column(type="date")
     */
    private \DateTimeInterface $postDate;

    /**
     * @ORM\Column(type="date")
     */
    private \DateTimeInterface $pickUpDate;

    public function __construct(Collection $products, string $destination, string $status, \DateTimeInterface $postDate, \DateTimeInterface $pickUpDate)
    {
        $this->products = $products;
        $this->destination = $destination;
        $this->status = $status;
        $this->postDate = $postDate;
        $this->pickUpDate = $pickUpDate;
    }
}
