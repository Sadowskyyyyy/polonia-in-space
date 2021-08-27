<?php
declare(strict_types=1);

namespace App\UI\Rest\Controller\MarsScientist;

use App\Application\Scientist\Application\Query\GetAllScientistsFromMarsResearchStation;
use App\UI\Rest\Controller\QueryController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/marsscientists")
 */
class MarsScientistsQueryController extends QueryController
{
    public function __construct(MessageBusInterface $queryBus)
    {
        parent::__construct($queryBus);
    }

    /**
     * @Route("/marsscientists")
     */
    public function getScientists(Request $request): Response
    {
        $response = $this->ask(new GetAllScientistsFromMarsResearchStation());
    }
}
