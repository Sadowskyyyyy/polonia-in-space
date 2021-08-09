<?php

namespace App\Application\Scientist\Domain;

abstract class AbstractScientist
{
    private int $id;
    private string $name;
    private string $surname;
    private string $password;

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

}