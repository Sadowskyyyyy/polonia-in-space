<?php
declare(strict_types=1);

namespace App\UI\Rest\Controller\MarsScientist;


use App\Command\MarkMarsScientistAsMissingOrDeadCommand;
use App\Command\RegisterScientistCommand;
use App\UI\rest\Controller\CommandController;
use App\UI\Rest\Response\ApiResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/marsscientists")
 */
class MarsScientistsCommandController extends CommandController
{
    public function __construct(MessageBusInterface $bus)
    {
        parent::__construct($bus);
    }

    /**
     * @Route(methods={"POST"})
     */
    public function registerScientist(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $this->handle(new RegisterScientistCommand($data['name'], $data['surname']));

        $response = new ApiResponse();
        return $response->setStatusCode(200);
    }

    /**
     * @Route(methods={"PATCH"})
     */
    public function markScientistAsMissingOrDead(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $command = new MarkMarsScientistAsMissingOrDeadCommand(
            (int)$data['id'],
            $data['reason'],
            (bool)$data['isMissing'],
            (bool)$data['isDead']
        );

        $this->handle($command);

        $response = new ApiResponse();
        return $response->setStatusCode(200);
    }
}
