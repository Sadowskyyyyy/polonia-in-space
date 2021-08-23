<?php
declare(strict_types=1);

namespace App\UI\Rest\Controller;

use App\Application\Shared\Application\Command\CommandInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DelayStamp;

abstract class CommandController extends AbstractController
{
    private MessageBusInterface $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    protected function handle(CommandInterface $command): void
    {
        $this->bus->dispatch($command);
    }
    protected function handleWithDelay(CommandInterface $command): void
    {
        $this->bus->dispatch(new Envelope($command), [
            new DelayStamp(840000),
        ]);
    }
}
