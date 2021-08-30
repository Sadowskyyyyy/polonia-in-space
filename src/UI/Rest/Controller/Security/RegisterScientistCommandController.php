<?php
declare(strict_types=1);

namespace App\UI\Rest\Controller\Security;

use App\Command\RegisterScientistCommand;
use App\UI\Rest\Controller\CommandController;
use Symfony\Component\HttpFoundation\Request;
use function json_decode;

class RegisterScientistCommandController extends CommandController
{
    public function registerScientist(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $this->handle(new RegisterScientistCommand(
            $data['name'],
            $data['surname'],
            $data['station']
        ));
    }
}
