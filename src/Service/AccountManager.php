<?php
declare(strict_types=1);

namespace App\Service;

use Symfony\Component\DependencyInjection\ContainerBuilder;

class AccountManager
{
    private PasswordValidator $passwordValidator;
    private ScientistStore $scientistStore;
    private ContainerBuilder $containerBuilder;

    public function generateToken(array $data): string
    {
        if (empty($data) === true) {
            throw new InvalidArgumentException();
        }

        $scientist = $this->scientistStore->getScientistByRoleAndName($data);
        $this->passwordValidator->isValidPassword($scientist, $data);

        return $this->containerBuilder->get('lexik_jwt_authentication.encoder')
            ->encode([
                'name' => $data['name'],
                'password' => $data['password'],
                'roles' => $data['roles']
            ]);
    }
}
