<?php

namespace App\Entity;

use App\DomainModel\Delivery;
use Doctrine\ORM\Mapping as ORM;

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


    public static function toDomain(DeliveryEntity $entity): Delivery
    {
        //TODO end
        return new Delivery(
            $entity->getSender(),
            ProductEntity::toDomain($entity->getProduct()),
            $entity->getStatus(),
            $entity->getStatus(),
            $entity->getPostDate(),
            $entity->getPickUpAddress()
        );
    }

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
