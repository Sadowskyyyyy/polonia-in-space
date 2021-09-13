<?php
declare(strict_types=1);

namespace App\Tests\Presentation\User;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function test(): void
    {
        //CREATE USER X
        $this->client->request(
            method: 'POST',
            uri: '/users',
        );

        $response = null;
        $json = $this->client->getResponse()->getContent();
        if (is_string($json)) {
            $response = json_decode($json, true);
            var_dump($response['id']);
        }

        $this->client->request(
            method: 'GET',
            uri: '/users/' . $response['id'],
        );

        self::assertResponseIsSuccessful();
    }
}