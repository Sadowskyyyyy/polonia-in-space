<?php
declare(strict_types=1);

namespace App\Tests\Presentation\User;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    public function test(): void
    {
        $this->client = static::createClient();

        //CREATE USER X
        $this->client->request(
            method: 'POST',
            uri: '/users',
        );

        $response = null;
        $json = $this->client->getResponse()->getContent();
        if (is_string($json)) {
            $response = json_decode($json, true);
        }

        $this->client->request(
            method: 'GET',
            uri: '/users/token/' . $response['apikey'],
        );

        self::assertResponseIsSuccessful();
    }
}
