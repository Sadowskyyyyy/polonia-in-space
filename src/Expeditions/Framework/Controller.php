<?php
declare(strict_types=1);

namespace App\Expeditions\Framework;

use App\Shared\Application\Command;
use App\Shared\Application\Query;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DelayStamp;
use Symfony\Component\Messenger\Stamp\HandledStamp;

abstract class Controller extends AbstractController
{
    private MessageBusInterface $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    protected function handle(Command $command): void
    {
        $this->bus->dispatch($command);
    }

    protected function handleWithDelay(Command $command): void
    {
        $this->bus->dispatch(new Envelope($command), [
            new DelayStamp(840000),
        ]);
    }

    protected function ask(Query $query): Envelope
    {
        $envelope = $this->bus->dispatch($query);
        /** @var HandledStamp $handled */
        $handled = $envelope->last(HandledStamp::class);

        return $handled->getResult();
    }

    protected function askWithDelay(Query $query): Envelope
    {
        $envelope = $this->bus->dispatch(new Envelope($query), [
            new DelayStamp(840000),
        ]);
        /** @var HandledStamp $handled */
        $handled = $envelope->last(HandledStamp::class);

        return $handled->getResult();
    }
}
