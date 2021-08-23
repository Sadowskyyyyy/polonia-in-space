<?php
declare(strict_types=1);

namespace App\Handler;

use App\Command\SendDeliveryCommand;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class SendDeliveryCommandHandler implements MessageHandlerInterface
{
    public function __invoke(SendDeliveryCommand $command)
    {
        // TODO: Implement __invoke() method.
    }

}