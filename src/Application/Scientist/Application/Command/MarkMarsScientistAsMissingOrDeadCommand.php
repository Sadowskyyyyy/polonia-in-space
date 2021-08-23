<?php

declare(strict_types=1);

namespace App\Application\Scientist\Application\Command;

use App\Application\Shared\Application\Command\CommandInterface;
use RuntimeException;

class MarkMarsScientistAsMissingOrDeadCommand implements CommandInterface
{
    public int $id;
    public string $reason;
    public bool $isMissing;
    public bool $isDead;

    public function __construct(int $id, string $reason, bool $isMissing, bool $isDead)
    {
        $this->id = $id;
        $this->reason = $reason;
        $this->isMissing = $isMissing;
        $this->isDead = $isDead;
        $this->validate();
    }

    private function validate()
    {
        if ((true === $this->isDead && true === $this->isMissing)
            || (false === $this->isDead && false === $this->isMissing)) {
            throw new RuntimeException('Data is not valid');
        }
    }
}
