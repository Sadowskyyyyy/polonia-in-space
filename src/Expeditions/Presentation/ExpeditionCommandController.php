<?php
declare(strict_types=1);

namespace App\Expeditions\Presentation;

use App\UI\Rest\Controller\CommandController;
use Symfony\Component\HttpFoundation\Request;
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
    }

    /**
     * @Route("/expeditions", name="CREATE_EXPEDITION", methods={"DELETE"})
     */
    public function createExpedition(Request $request)
    {
        $data = json_decode($request->getContent(), true);
    }
}
