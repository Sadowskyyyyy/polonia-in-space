<?php
declare(strict_types=1);

namespace App\DomainModel;

use App\Exception\DiffrentSenderException;

abstract class AbstractScientist
{
    protected int $id;
    protected string $name;
    protected string $surname;
    protected string $password;
    protected array $sentDeliveries = [];

    public function __construct(int $id, string $name, string $surname, string $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->password = $password;
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

    public function getPassword(): string
    {
        return $this->password;
    }

    public function changePassword(string $password): void
    {
        $this->password = $password;
    }

    public function addDelivery(Delivery $delivery): void
    {
        if ($delivery->getSender()->surname === $this->surname && $delivery->getSender()->name === $this->name) {
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
