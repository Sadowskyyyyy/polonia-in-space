<?php
declare(strict_types=1);

namespace App\Expeditions\Presentation;

use App\Expeditions\Application\Command\CreateExpeditionCommand;
use App\Expeditions\Application\Command\DeleteExpeditionCommand;
use App\Expeditions\Domain\ExpeditionRepository;
use App\Expeditions\Framework\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExpeditionQueryController extends Controller
{
    /**
     * @Route("/expeditions/{id}", name="FIND_EXPEDITION", methods={"GET"})
     */
    public function findExpeditionById(int $id, ExpeditionRepository $repository): Response
    {
        return new JsonResponse($repository->findById($id));
    }

    /**
     * @Route("/expeditions", name="FIND_EXPEDITIONS", methods={"GET"})
     */
    public function findExpeditions(ExpeditionRepository $repository): Response
    {
        return new JsonResponse($repository->findAll());
    }
    /**
     * @Route("/expeditions", name="CREATE_EXPEDITION", methods={"POST"})
     */
    public function createExpedition(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $this->handle(new CreateExpeditionCommand($data['name'], $data['plannedDate']));

        return new JsonResponse([], 200);
    }

    /**
     * @Route("/expeditions/{id}", name="DELETE_EXPEDITION", methods={"DELETE"})
     */
    public function deleteExpedition(int $id): Response
    {
        $this->handle(new DeleteExpeditionCommand($id));

        return new JsonResponse([], 204);
    }
}
