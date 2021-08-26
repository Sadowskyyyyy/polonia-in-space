<?php
declare(strict_types=1);

namespace App\Service;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

class PasswordValidator
{
    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    public function isValidPassword($user, array $data): bool
    {
        if (!$this->encoder->isPasswordValid($user, $data['password'], null)){
            throw new BadCredentialsException();
        }

        return true;
    }

}
