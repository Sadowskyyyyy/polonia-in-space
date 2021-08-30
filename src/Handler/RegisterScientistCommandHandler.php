<?php
declare(strict_types=1);

namespace App\Handler;

use App\Command\RegisterScientistCommand;
use App\Service\ScientistFactory;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class RegisterScientistCommandHandler implements MessageHandlerInterface
{
    public function __invoke(RegisterScientistCommand $command)
    {
        ScientistFactory::createFromCommand($command, $station);
    }
}
