<?php
declare(strict_types=1);

namespace App\Security;

use App\Service\ScientistStore;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\AuthorizationHeaderTokenExtractor;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class TokenGuard extends AbstractGuardAuthenticator
{
    private JWTEncoderInterface $encoder;
    private ScientistStore $scientistStore;
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(JWTEncoderInterface $encoder, ScientistStore $scientistStore, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->encoder = $encoder;
        $this->scientistStore = $scientistStore;
        $this->passwordEncoder = $passwordEncoder;
    }


    public function start(Request $request, AuthenticationException $authException = null)
    {
        // TODO: Implement start() method.
    }

    public function supports(Request $request)
    {
        // TODO: Implement supports() method.
    }

    public function getCredentials(Request $request)
    {
        $extractor = new AuthorizationHeaderTokenExtractor(
            'Bearer',
            'Authorization'
        );

        $token = $extractor->extract($request);

        if (empty($token) === true) {
            return;
        }

        return $token;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $data = $this->encoder->decode($credentials);

        return $this->scientistStore->getScientistByRoleAndName($data['name'], $data['password'], $data['roles']);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return $this->passwordEncoder->isPasswordValid($user, $credentials['password'], null);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        // TODO: Implement onAuthenticationFailure() method.
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // TODO: Implement onAuthenticationSuccess() method.
    }

    public function supportsRememberMe()
    {
        return false;
    }
}
