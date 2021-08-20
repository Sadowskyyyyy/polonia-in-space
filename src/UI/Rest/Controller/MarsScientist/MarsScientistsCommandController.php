<?php
declare(strict_types=1);

namespace App\UI\Rest\Controller\MarsScientist;

use App\Command\MarkMarsScientistAsMissingOrDeadCommand;
use App\Command\RegisterScientistCommand;
use App\UI\Rest\Controller\CommandController;
use App\UI\Rest\Response\ApiResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

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
     * @IsGranted("ROLE_MARS_SCIENTIST")
     * @Route(methods={"POST"})
     */
    public function registerScientist(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $command = new RegisterScientistCommand(
            $data['name'],
            $data['surname']
        );

        $this->handle($command);

        $response = new ApiResponse();
        return $response->setStatusCode(200);
    }

    /**
     * @IsGranted("ROLE_MARS_SCIENTIST")
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

        $response = new ApiResponse();
        return $response->setStatusCode(200);
    }
}
