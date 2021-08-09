<?php

declare(strict_types=1);

namespace App\UI\rest\Controller\Expedition;

use App\UI\rest\Controller\CommandController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/expeditions", methods={"GET"})
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
    public function startExpedition(Request $request, int $id)
    {
        $data = json_decode($request->getContent(), true);

        $command = new StartExpeditionCommand(
            );

        $this->handle($command);
    }

    /**
     * @Route(methods={"POST"})
     */
    public function planNewExpedition(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $command = new PlanNewExpeditionCommand(
        );

        $this->handle($command);
    }

    /**
     * @Route("/{id}", methods={"PATCH"})
     */
    public function finishExpedition(Request $request, int $id)
    {
        $data = json_decode($request->getContent(), true);

        $command = new FinishExpeditionCommand(
        );

        $this->handle($command);
    }
}