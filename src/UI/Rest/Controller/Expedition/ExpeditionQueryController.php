<?php

namespace App\UI\Rest\Controller\Expedition;

use App\Application\Expedition\Application\Query\GenerateExpeditionConclusionQuery;
use App\UI\rest\Controller\QueryController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * @Route("/expeditions")
 */
class ExpeditionQueryController extends QueryController
{
    public function __construct(MessageBusInterface $queryBus)
    {
        parent::__construct($queryBus);
    }

    /**
     * @Route("/conclusion/{id}", methods={"GET"})
     */
    public function generateExpeditionConclusion(int $id): Response
    {
        $query = $this->ask(new GenerateExpeditionConclusionQuery($id));
    }
}