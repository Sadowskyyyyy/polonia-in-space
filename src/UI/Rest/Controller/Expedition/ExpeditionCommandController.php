<?php
declare(strict_types=1);

namespace App\UI\Rest\Controller\Expedition;

use App\Application\Expedition\Application\Command\FinishExpeditionCommand;
use App\Application\Expedition\Application\Command\PlanNewExpeditionCommand;
use App\Application\Expedition\Application\Command\StartExpeditionCommand;
use App\UI\rest\Controller\CommandController;
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
     * @IsGranted("ROLE_MARS_SCIENTIST")
     * @Route("/{id}", methods={"PATCH"})
     */
    public function startExpedition(Request $request, int $id): Response
    {
        $data = json_decode($request->getContent(), true);

        $command = new StartExpeditionCommand($id);
        $this->handle($command);

    }

    /**
     * @IsGranted("ROLE_MARS_SCIENTIST")
     * @Route(methods={"POST"})
     */
    public function planNewExpedition(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $command = new PlanNewExpeditionCommand(
            $data['plannedStartDate']
        );

        $this->handle($command);

    }

    /**
     * @IsGranted("ROLE_MARS_SCIENTIST")
     * @Route("/{id}", methods={"PATCH"})
     */
    public function finishExpedition(Request $request, int $id): Response
    {
        $data = json_decode($request->getContent(), true);

        $command = new FinishExpeditionCommand(
            $id
        );

        $this->handle($command);

    }
}
