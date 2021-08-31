<?php

declare(strict_types=1);

namespace App\Command;

use App\Shared\Application\Command;
use RuntimeException;

class MarkMarsScientistAsMissingOrDeadCommand implements Command
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
        if (true === $this->isDead && true === $this->isMissing) {
            throw new RuntimeException('Data is not valid');
        }
    }
}
