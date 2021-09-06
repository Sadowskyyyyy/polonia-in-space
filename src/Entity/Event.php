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
    public int $id;

    /**
     * @ORM\Column(type="date")
     */
    public \DateTimeImmutable $creationDate;

    /**
     * @ORM\Column(type="string", length=16)
     */
    public string $storageLocation;
}
