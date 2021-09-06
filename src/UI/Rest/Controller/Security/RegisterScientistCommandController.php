<?php
declare(strict_types=1);

namespace App\UI\Rest\Controller\Security;

use App\Command\RegisterScientistCommand;
use App\UI\Rest\Controller\CommandController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function json_decode;

class RegisterScientistCommandController extends CommandController
{
    /**
     * @Route("/users", methods={"POST"})
     */
    public function registerScientist(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $this->handle(new RegisterScientistCommand(
            $data['name'],
            $data['surname'],
            $data['station']
        ));

        return new Response(['xd']);
    }
}
