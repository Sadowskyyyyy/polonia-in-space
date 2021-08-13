<?php

namespace App\Entity;

/**
 * @ORM\Entity(repositoryClass=DeliveryEntityRepository::class)
 */
class DeliveryEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=SpaceScientistEntity::class, inversedBy="sentDeliveries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sender;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSender(): ?SpaceScientistEntity
    {
        return $this->sender;
    }

    public function setSender(?SpaceScientistEntity $sender): self
    {
        $this->sender = $sender;

        return $this;
    }
}
