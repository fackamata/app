<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CguFunctionalTest extends WebTestCase
{
    public function testShouldDisplayApropos(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/cgu');

        $this->assertResponseIsSuccessful();
    }
}