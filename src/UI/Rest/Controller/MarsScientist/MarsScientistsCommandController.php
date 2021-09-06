<?php
declare(strict_types=1);

namespace App\UI\Rest\Controller\MarsScientist;

use App\Command\MarkMarsScientistAsMissingOrDeadCommand;
use App\Service\MarkMarsScientistAsMissingOrDeadCommandValidator;
use App\UI\Rest\Controller\CommandController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/marsscientists")
 */
class MarsScientistsCommandController extends CommandController
{
    private MarkMarsScientistAsMissingOrDeadCommandValidator $validator;
    public function __construct(MessageBusInterface $bus, MarkMarsScientistAsMissingOrDeadCommandValidator $validator)
    {
        $this->validator = $validator;
        parent::__construct($bus);
    }

    /**
     * @Route(methods={"PATCH"})
     */
    public function markScientistAsMissingOrDead(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $command = new MarkMarsScientistAsMissingOrDeadCommand(
            (int) $data['id'],
            $data['reason'],
            (bool) $data['isMissing'],
            (bool) $data['isDead']
        );

        $this->handle($command);

        return new Response([], 200);
    }
}
