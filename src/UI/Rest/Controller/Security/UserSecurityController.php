<?php
declare(strict_types=1);

namespace App\UI\Rest\Controller\Security;

use App\Service\ApiKeyGenerator;
use App\Service\AuthFactory;
use JsonApiPhp\JsonApi\Attribute;
use JsonApiPhp\JsonApi\DataDocument;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\ResourceObject;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class UserSecurityController extends AbstractController
{
    private ApiKeyGenerator $generator;
    private AuthFactory $userFactory;

    public function __construct(ApiKeyGenerator $generator, AuthFactory $userFactory)
    {
        $this->generator = $generator;
        $this->userFactory = $userFactory;
    }

    /**
     * @Route("/users", methods={"GET"})
     */
    public function findCurrentUser(Request $request): JsonResponse
    {
        return $this->json(
            new DataDocument(
                new ResourceObject(
                    'user',
                    '1',
                    new Attribute('user', 'test'),
                    new SelfLink('/users')
                )
            )
        );
    }

    /**
     * @Route("/users/apikey", methods={"GET"})
     */
    public function findCurrentApikey(Request $request): JsonResponse
    {
        return $this->json(
            new DataDocument(
                new ResourceObject(
                    'apikey',
                    '1',
                    new Attribute('apikey', $this->getUser()->getUsername()),
                    new SelfLink('/users/apikey')
                )
            )
        );
    }

    /**
     * @Route("/users/generate", methods={"POST"})
     */
    public function generateApikey(Request $request): JsonResponse
    {
        return $this->json(
            new DataDocument(
                new ResourceObject(
                    'user',
                    '1',
                    new Attribute('apikey', $this->generator->generateApiKey()),
                    new SelfLink('/users/generate')
                )
            )
        );
    }
}
