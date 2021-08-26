<?php
declare(strict_types=1);

namespace App\Service;

use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;

class AccountManager
{
    private PasswordValidator $passwordValidator;
    private ScientistStore $scientistStore;
    private JWTEncoderInterface $encoder;

    public function generateToken(array $data): string
    {
        if (empty($data) === true) {
            throw new InvalidArgumentException();
        }

        $scientist = $this->scientistStore->getScientistByRoleAndName($data['name'], $data['password'], $data['roles']);
        $this->passwordValidator->isValidPassword($scientist, $data);

        return $this->encoder->encode([
            'name' => $data['name'],
            'password' => $data['password'],
            'roles' => $data['roles']
        ]);
    }
}
