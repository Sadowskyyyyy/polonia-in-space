<?php

namespace App\UI\rest\Controller\Expedition;

use App\UI\rest\Controller\CommandController;
use App\UI\rest\Controller\QueryController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/expeditions")
 */
class ExpeditionQueryController extends QueryController
{
    public function __construct(MessageBusInterface $bus)
    {
        parent::__construct($bus);
    }

    /**
     * @Route("/{id}", methods={"GET"})
     */
    public function generateExpeditionConclusion(int $id): Response
    {
        $query = $this->ask(new GenerateExpeditionConclusion($id));
    }
}