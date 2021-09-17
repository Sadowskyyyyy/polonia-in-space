<?php
declare(strict_types=1);

namespace App\Expeditions\Presentation;

use App\Expeditions\Domain\Entity\User;
use App\Service\ApiKeyGenerator;
use App\Users\Domain\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/users", name="CREATE_USER")
     */
    public function createNewUser(Request $request, UserRepository $repository, ApiKeyGenerator $apiKeyGenerator): Response
    {
        $apikey = $apiKeyGenerator->generateApiKey();

        $repository->save(new User([], $apikey));
        $user = $repository->findOneByApikey($apikey);

        return new JsonResponse($user);
    }

    /**
     * @Route("/users/token", name="GET_USER_BY_ACTUAL_TOKEN", methods={"GET"})
     */
    public function findUserByActualToken(Request $request, UserRepository $repository): Response
    {
        $apiToken = $request->headers->get('X-AUTH-TOKEN');
        $user = $repository->findOneByApikey($apiToken);

        return new JsonResponse($user);
    }

    /**
     * @Route("/users/user", name="GET_USER_BY_SYMFONY", methods={"GET"})
     */
    public function findUserBySymfonySecurity(Request $request, UserRepository $repository): Response
    {
        return new JsonResponse($this->getUser());
    }
}
