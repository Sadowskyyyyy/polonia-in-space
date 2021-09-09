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
        $response = json_decode($this->client->getResponse()->getContent(), true);

        //GET EXPEDITION X
//        $this->client->request(
//            method: 'GET',
//            uri: '/expeditions/' . $response[0]['id'],
//        );
//        self::assertResponseIsSuccessful();

        //GET ALL EXPEDITIONS

        //DELETE EXPEDITION X

        //CHECK THAT EXPEDITION X NOT EXISTS
    }

    public function testDeletingExpedition(): void
    {
        $this->client->request('DELETE', '/expeditions/1');

        self::assertResponseIsSuccessful();
    }

    public function testCreatingExpedition(): void
    {
        $this->client->request(
            method: 'POST',
            uri: '/expeditions',
            content: json_encode([
                'name' => 'test-name',
                'plannedDate' => '2021-10-23',
            ], JSON_THROW_ON_ERROR),
        );

        self::assertResponseIsSuccessful();
    }
}
