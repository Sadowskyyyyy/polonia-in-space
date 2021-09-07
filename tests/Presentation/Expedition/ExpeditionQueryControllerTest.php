<?php
declare(strict_types=1);

namespace App\Tests\Presentation\Expedition;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ExpeditionQueryControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testDeletingExpedition(): void
    {
        $crawler = $this->client->request('DELETE', '/expeditions/1');

        $this->assertResponseIsSuccessful();
    }

    public function testCreatingExpedition(): void
    {
        $crawler = $this->client->request('POST', '/expeditions');

        $this->assertResponseIsSuccessful();
    }
}