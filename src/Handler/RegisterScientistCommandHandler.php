<?php
declare(strict_types=1);

namespace App\Handler;

use App\Command\RegisterScientistCommand;
use App\Service\ScientistFactory;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class RegisterScientistCommandHandler implements MessageHandlerInterface
{
    private ScientistFactory $factory;

    public function __construct(ScientistFactory $factory)
    {
        $this->factory = $factory;
    }

    public function __invoke(RegisterScientistCommand $command): void
    {
        $this->factory->createFromCommand($command);
    }
}
