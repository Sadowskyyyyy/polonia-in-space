<?php
declare(strict_types=1);

namespace App\UI\Rest\Controller\User;

use App\DomainModel\Repository\UserRepository;
use App\Entity\User;
use App\Service\ApiKeyGenerator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserCommandController
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
     * @Route("/users/{id}", name="GET_USER")
     */
    public function findUserById(int $id, UserRepository $repository): Response
    {
        $user = $repository->findById($id);

        return new JsonResponse($user);
    }
}
