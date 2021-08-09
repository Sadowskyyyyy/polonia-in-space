<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\ResarchStation;

use App\UI\rest\Controller\CommandController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ResearchStationController extends CommandController
{
    public function __construct(MessageBusInterface $bus)
    {
        parent::__construct($bus);
    }

    public function changeAngle(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $command = new ChangeAngleCommand();

        $this->handle($command);
    }

    public function reportRequest(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $command = new ReportARequestCommand();

        $this->handleWithDelay($command);
    }
}