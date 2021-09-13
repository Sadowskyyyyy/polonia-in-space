<?php
declare(strict_types=1);

namespace App\Tests\Presentation\Expedition;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ExpeditionControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function test(): void
    {
        //CREATE EXPEDITION X
        $this->client->request(
            method: 'POST',
            uri: '/expeditions',
            content: json_encode([
                'name' => 'test-name',
                'plannedDate' => '2021-10-23',
            ], JSON_THROW_ON_ERROR),
        );

        $response = null;
        $json = $this->client->getResponse()->getContent();
        if (is_string($json)) {
            $response = json_decode($json, true);
        }
        $this->client->request(
            method: 'GET',
            uri: '/expeditions/' . $response['id'],
        );

        self::assertResponseIsSuccessful();

        //GET ALL EXPEDITIONS
        $this->client->request(
            method: 'GET',
            uri: '/expeditions',
        );

        self::assertResponseIsSuccessful();
        //DELETE EXPEDITION X
        $this->client->request(
            method: 'DELETE',
            uri: '/expeditions/' . $response['id'],
        );

        self::assertResponseIsSuccessful();

        //CHECK THAT EXPEDITION X NOT EXISTS
        $this->client->request(
            method: 'GET',
            uri: '/expeditions/' . $response['id'],
        );

        self::assertResponseStatusCodeSame(404);
    }
}
