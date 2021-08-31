<?php
declare(strict_types=1);

namespace App\UI\Rest\Controller\Expedition;

use App\Command\FinishExpeditionCommand;
use App\Command\PlanNewExpeditionCommand;
use App\Command\StartExpeditionCommand;
use App\UI\Rest\Controller\CommandController;
use App\UI\Rest\Response\ApiResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/expeditions")
 */
class ExpeditionCommandController extends CommandController
{
    public function __construct(MessageBusInterface $bus)
    {
        parent::__construct($bus);
    }

    /**
     * @Route("/{id}", methods={"PATCH"})
     */
    public function startExpedition(Request $request, int $id): Response
    {
        $data = json_decode($request->getContent(), true);
        $this->handle(new StartExpeditionCommand($id));

        $response = new ApiResponse();

        return $response->setStatusCode(200);
    }

    /**
     * @Route(methods={"POST"})
     */
    public function planNewExpedition(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $this->handle(new PlanNewExpeditionCommand($data['plannedStartDate']));

        $response = new ApiResponse();

        return $response->setStatusCode(200);
    }

    /**
     * @Route("/{id}", methods={"PATCH"})
     */
    public function finishExpedition(Request $request, int $id): Response
    {
        $data = json_decode($request->getContent(), true);
        $this->handle(new FinishExpeditionCommand($id));

        $response = new ApiResponse();

        return $response->setStatusCode(200);
    }
}
