<?php
declare(strict_types=1);

namespace App\UI\Rest\Controller\Security;

use App\Service\ApiKeyGenerator;
use JsonApiPhp\JsonApi\Attribute;
use JsonApiPhp\JsonApi\DataDocument;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\ResourceObject;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserSecurityController extends AbstractController
{
    private ApiKeyGenerator $generator;

    public function __construct(ApiKeyGenerator $generator)
    {
        $this->generator = $generator;
    }

    /**
     * @Route("/users", methods={"GET"})
     */
    public function findCurrentUser(Request $request): JsonResponse
    {
        $response = json_encode(
            new DataDocument(
                new ResourceObject(
                'user',
                '1',
                new Attribute('user', $this->getUser()),
                new SelfLink('/users')
            )
            )
        );

        return $this->json(json_decode($response));
    }

    /**
     * @Route("/users/apikey", methods={"GET"})
     */
    public function findCurrentApikey(Request $request): JsonResponse
    {
        $response = json_encode(
            new DataDocument(
                new ResourceObject(
                'apikey',
                '1',
                new Attribute('apikey', $this->getUser()->getUsername()),
                new SelfLink('/users/apikey')
            )
            )
        );

        return $this->json(json_decode($response));
    }

    /**
     * @Route("/users/generate", methods={"GET"})
     */
    public function generateApikey(Request $request): JsonResponse
    {
        $response = json_encode(
            new DataDocument(
                new ResourceObject(
                'apikey',
                '1',
                new Attribute('apikey', $this->generator->generateApiKey()),
                new SelfLink('/users/generate')
            )
            )
        );

        return $this->json(json_decode($response));
    }
}
