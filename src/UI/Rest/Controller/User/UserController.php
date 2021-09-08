<?php
declare(strict_types=1);

namespace App\UI\Rest\Controller\User;

use App\Entity\User;
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
        $data = json_decode($request->getContent(), true);
        $apikey = $apiKeyGenerator->generateApiKey();

        $repository->save(new User($data['name'], [], 'xd'));

        return new JsonResponse(utf8_encode($apikey));
    }

    /**
     * @Route("/users/{id}", name="GET_USER", methods={"GET"})
     */
    public function findUserById(int $id, UserRepository $repository): Response
    {
        $user = $repository->findById($id);

        return new JsonResponse($user);
    }

    /**
     * @Route("/users/token", name="GET_USER", methods={"GET"})
     */
    public function findUserByActualToken(Request $request, UserRepository $repository): Response
    {
        $apiToken = $request->headers->get('X-AUTH-TOKEN');
        $user = $repository->findOneByApikey($apiToken);

        return new JsonResponse($user);
    }

    /**
     * @Route("/users/user", name="GET_USER", methods={"GET"})
     */
    public function findUserBySymfonySecurity(Request $request, UserRepository $repository): Response
    {
        $user = $this->getUser();
        $user = $repository->findById((int)$user->getUsername());

        return new JsonResponse($user);
    }
}
