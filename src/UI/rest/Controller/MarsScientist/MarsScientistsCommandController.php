<?php

declare(strict_types=1);

namespace App\UI\rest\Controller\MarsScientist;

use App\Application\Scientist\Application\Command\MarkMarsScientistAsMissingOrDeadCommand;
use App\Application\Scientist\Application\Command\RegisterScientistCommand;
use App\UI\rest\Controller\CommandController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/marsscientists", methods={"GET"})
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
    public function registerScientist(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $command = new RegisterScientistCommand(
            $data['name'],
            $data['surname']
        );

        $this->handle($command);
    }

    /**
     * @Route(methods={"PATCH"})
     */
    public function markScientistAsMissing(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $command = new MarkMarsScientistAsMissingOrDeadCommand(
            (int)$data['id'],
            $data['reason'],
            (bool)$data['isMissing'],
            (bool)$data['isDead']
        );

        $this->handle($command);
    }
}