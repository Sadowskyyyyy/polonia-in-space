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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setDelivery($this);
        }

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPostDate(): ?\DateTimeInterface
    {
        return $this->postDate;
    }

    public function setPostDate(\DateTimeInterface $postDate): self
    {
        $this->postDate = $postDate;

        return $this;
    }

    public function getPickUpDate(): ?\DateTimeInterface
    {
        return $this->pickUpDate;
    }

    public function setPickUpDate(\DateTimeInterface $pickUpDate): self
    {
        $this->pickUpDate = $pickUpDate;

        return $this;
    }
}
