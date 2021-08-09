<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\MarsScientist;

use App\UI\rest\Controller\QueryController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/marsscientists")
 */
class MarsScientistsQueryController extends QueryController
{
    public function __construct(MessageBusInterface $bus)
    {
        parent::__construct($bus);
    }

    public function getAllScientists(Request $request)
    {
        $query = new GetAllScientistsFromMarsResarchStation();

        $this->ask($query);


    }

}