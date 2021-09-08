<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
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
