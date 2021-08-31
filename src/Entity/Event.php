<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EventRepository::class)
 */
class Event
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
    private \DateTimeImmutable $creationDate;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private string $storageLocation;

    public function getId(): int
    {
        return $this->id;
    }

    public function getCreationDate(): \DateTimeImmutable
    {
        return $this->creationDate;
    }

    public function getStorageLocation(): string
    {
        return $this->storageLocation;
    }
}
