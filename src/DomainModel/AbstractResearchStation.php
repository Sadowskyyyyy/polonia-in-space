<?php
declare(strict_types=1);

namespace App\DomainModel;

use App\Shared\Domain\Event\Event;

abstract class AbstractResearchStation
{
    private int $id;
    private array $scientists = [];
    private array $products = [];
    private array $events = [];
    private bool $needHelp = false;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    abstract public function addScientist(AbstractScientist $scientist): void;

    public function addProduct(Product $product): void
    {
        $this->products[] = $product;
    }

    public function addEvent(Event $event)
    {
        $this->events[] = $event;
    }

    public function getProducts(): array
    {
        if (true === empty($this->products)) {
            $this->askForHelp();
        }

        return $this->products;
    }

    public function askForHelp(): bool
    {
        return $this->needHelp = true;
    }

    public function getEvents(): array
    {
        return $this->events;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getScientists(): array
    {
        return $this->scientists;
    }

    public function isNeedHelp(): bool
    {
        return $this->needHelp;
    }
}
