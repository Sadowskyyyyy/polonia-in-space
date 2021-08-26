<?php
declare(strict_types=1);

namespace App\Service;

use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

class PasswordValidator
{
    private PasswordEncoderInterface $encoder;

    public function __construct(PasswordEncoderInterface $encoder)
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
