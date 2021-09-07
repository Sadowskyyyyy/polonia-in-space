<?php
declare(strict_types=1);

namespace App\Presentation\Expedition;

use App\Expeditions\Application\Query\FindExpeditionByIdQuery;
use App\Expeditions\Application\Query\FindExpeditionsQuery;
use App\Presentation\QueryController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class ExpeditionQueryController extends QueryController
{
    public function __construct(MessageBusInterface $queryBus)
    {
        parent::__construct($queryBus);
    }

    /**
     * @Route("/expeditions/{id}", name="FIND_EXPEDITION", methods={"GET"})
     */
    public function findExpeditionById(int $id): Response
    {
        $response = $this->ask(new FindExpeditionByIdQuery($id));

        return new JsonResponse($response);
    }

    /**
     * @Route("/expeditions", name="FIND_EXPEDITIONS", methods={"GET"})
     */
    public function findExpeditions(): Response
    {
        $response = $this->ask(new FindExpeditionsQuery());

        return new JsonResponse($response);
    }
}
