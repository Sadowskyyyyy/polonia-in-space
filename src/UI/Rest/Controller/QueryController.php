<?php

declare(strict_types=1);

namespace App\UI\rest\Controller;

use App\Application\Shared\Application\Query\QueryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DelayStamp;
use Symfony\Component\Messenger\Stamp\HandledStamp;

abstract class QueryController extends AbstractController
{
    private MessageBusInterface $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    protected function ask(QueryInterface $query): Envelope
    {
        $envelope = $this->bus->dispatch($query);
        /** @var HandledStamp $handled*/
        $handled = $envelope->last(HandledStamp::class);

        return $handled->getResult();
    }

    protected function askWithDelay(QueryInterface $query): Envelope
    {
       $envelope = $this->bus->dispatch(new Envelope($command), [
            new DelayStamp(840000)
        ]);
        /** @var HandledStamp $handled*/
        $handled = $envelope->last(HandledStamp::class);

        return $handled->getResult();
    }
}