<?php

declare(strict_types=1);

namespace App\Handler;

use App\Application\ResarchStation\Application\Command\ReportARequestCommand;
use App\Application\ResarchStation\Application\Event\ReportedARequest;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

//TODO tests and event repo
class ReportARequestCommandHandler implements MessageHandlerInterface
{
    private EventRepositoryInterface $eventRepository;

    public function __invoke(ReportARequestCommand $command)
    {
        $this->eventRepository->save(new ReportedARequest($command->destination));
    }

}