<?php
declare(strict_types=1);

namespace App\DomainModel;

use App\Exception\DiffrentSenderException;

abstract class AbstractScientist
{
    protected int $id;
    protected string $apikey;
    protected string $name;
    protected string $surname;
    protected array $sentDeliveries = [];

    public function __construct(string $name, string $surname, string $apikey)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->apikey = $apikey;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function changeName(string $name): void
    {
        $this->name = $name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function changeSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function getApikey(): string
    {
        return $this->apikey;
    }

    public function setApikey(string $apikey): void
    {
        $this->apikey = $apikey;
    }

    public function addDelivery(Delivery $delivery): void
    {
        if ($delivery->getSender()->id === $this->id) {
            $this->sentDeliveries[] = $delivery;
        }

        throw new DiffrentSenderException();
    }

    public function getSentDeliveries(): array
    {
        return $this->sentDeliveries;
    }

    public function setSentDeliveries(array $sentDeliveries): void
    {
        $this->sentDeliveries = $sentDeliveries;
    }
}
