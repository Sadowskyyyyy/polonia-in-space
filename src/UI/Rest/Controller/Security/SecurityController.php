<?php
declare(strict_types=1);

namespace App\UI\Rest\Controller\Security;

use App\Service\AccountManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use JsonApiPhp\JsonApi\Attribute;
use JsonApiPhp\JsonApi\DataDocument;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\ResourceObject;
use Symfony\Component\Routing\Annotation\Route;
use function json_decode;

/**
 * @Route("/tokens")
 */
class SecurityController extends AbstractController
{
    private AccountManager $accountManager;

    public function __construct(AccountManager $accountManager)
    {
        $this->accountManager = $accountManager;
    }

    /**
     * @Route("/generate", methods={"POST"})
     */
    public function generateToken(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        return json_encode(new DataDocument(
                new ResourceObject(
                    'token',
                    '1',
                    new Attribute('token', $this->accountManager->generateToken($data)),
                    new SelfLink(sprintf('/tokens/generate')
                )
            )
        );
    }
}
