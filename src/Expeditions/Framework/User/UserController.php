<?php
declare(strict_types=1);

namespace App\Expeditions\Framework\User;

use App\Expeditions\Domain\Entity\User;
use App\Service\ApiKeyGenerator;
use App\Users\Domain\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/users", name="CREATE_USER")
     */
    public function createNewUser(Request $request, UserRepository $repository, ApiKeyGenerator $apiKeyGenerator): Response
    {
        $apikey = $apiKeyGenerator->generateApiKey();

        $repository->save(new User([], $apikey));

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
    public function findUserBySymfonySecurity(Request $request, UserRepository $repository, UserInterface $user): Response
    {
        $user = $repository->findById((int) $user->getUsername());

        return new JsonResponse($user);
    }
}
