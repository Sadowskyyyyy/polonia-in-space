<?php
declare(strict_types=1);

namespace App\UI\Rest\Controller\ResarchStation;

use App\Command\ChangeAngleCommand;
use App\Command\ReportARequestCommand;
use App\UI\Rest\Controller\CommandController;
use App\UI\Rest\Response\ApiResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/angle", methods={"PATCH"})
     */
    public function changeAngle(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $this->handle(new ChangeAngleCommand($data['degrees']));

        $response = new ApiResponse();
        return $response->setStatusCode(200);
    }

    /**
     * @Route("/report", methods={"PATCH"})
     */
    public function reportRequest(Request $request): Response
    {
        $destination = $request->query->get('destination');
        $this->handleWithDelay(new ReportARequestCommand($destination));

        $response = new ApiResponse();
        return $response->setStatusCode(200);
    }
}
