<?php
declare(strict_types=1);

namespace App\Presentation\Expedition;

use App\Expeditions\Application\Command\DeleteExpeditionCommand;
use App\Presentation\CommandController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class ExpeditionCommandController extends CommandController
{
    public function __construct(MessageBusInterface $bus)
    {
        parent::__construct($bus);
    }

    /**
     * @Route("/expeditions", name="CREATE_EXPEDITION", methods={"POST"})
     */
    public function createExpedition(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $this->handle(new CreateExpeditionCommand());

        return new Response([], 200);
    }

    /**
     * @Route("/expeditions/{id}", name="DELETE_EXPEDITION", methods={"DELETE"})
     */
    public function deleteExpedition(Request $request, int $id)
    {
        $this->handle(new DeleteExpeditionCommand($id));

        return new Response([], 204);
    }
}
