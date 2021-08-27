<?php

namespace App\Entity;

use App\Repository\DeliveryRepository;
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
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=SpaceScientist::class, inversedBy="sentDeliveries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sender;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSender(): ?SpaceScientist
    {
        return $this->sender;
    }

    public function setSender(?SpaceScientist $sender): self
    {
        $this->sender = $sender;

        return $this;
    }
}
