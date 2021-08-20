<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\ResarchStation;

use App\Command\ChangeAngleCommand;
use App\Command\ReportARequestCommand;
use App\UI\rest\Controller\CommandController;
use App\UI\Rest\Response\ApiResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * @Route("/researchstations")
 */
class ResearchStationCommandController extends CommandController
{
    public function __construct(MessageBusInterface $bus)
    {
        parent::__construct($bus);
    }

    /**
     * @IsGranted("ROLE_SPACE_SCIENTIST")
     * @Route("/angle", methods={"PATCH"})
     */
    public function changeAngle(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $command = new ChangeAngleCommand($data['degrees']);

        $this->handle($command);

        $response = new ApiResponse();
        return $response->setStatusCode(200);
    }

    /**
     * @Route("/report", methods={"PATCH"})
     */
    public function reportRequest(Request $request): Response
    {
        $destination = $request->query->get('destination');
        $command = new ReportARequestCommand($destination);

        $this->handleWithDelay($command);

        $response = new ApiResponse();
        return $response->setStatusCode(200);
    }
}
