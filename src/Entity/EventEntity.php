<?php
declare(strict_types=1);

namespace App\Entity;

use DateTimeInterface;

/**
 * @ORM\Entity(repositoryClass=EventEntityRepository::class)
 */
class EventEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="date")
     */
    private $creationDate;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private string $storageLocation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreationDate(): ?DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getStorageLocation(): ?string
    {
        return $this->storageLocation;
    }

    public function setStorageLocation(string $storageLocation): self
    {
        $this->storageLocation = $storageLocation;

        return $this;
    }
}
