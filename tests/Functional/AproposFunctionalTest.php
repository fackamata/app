<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AproposFunctionalTest extends WebTestCase
{
    public function testShouldDisplayApropos(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/apropos');

        $this->assertResponseIsSuccessful();
    }
}

