<?php

namespace App\Tests\Functional;

use App\DataFixtures\AppFixtures;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AvisFunctionalTest extends WebTestCase
{
    use FixturesTrait;

    public function testShouldDisplayAvisIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/avis/');
        $this->assertSelectorTextContains('h1', 'Liste des commentaires');
    }

    public function testShouldDisplayOneAvis()
    {
        $client = static::createClient();
        $fixtures = $this->loadFixtures([AppFixtures::class])->getReferenceRepository();

        $user = $fixtures->getReference('user_admin');
        $client->loginUser($user);
        $avis = $fixtures->getReference('avis_2');
        $client->request('GET', '/avis/'.$avis->getId());

        $this->assertResponseIsSuccessful();
    }

    public function testShouldCreateNewAvis()
    {
        $client = static::createClient();
        $fixtures = $this->loadFixtures([AppFixtures::class])->getReferenceRepository();

        $conseil = $fixtures->getReference('conseil_3');
        $conseilId = $conseil->getId();
        $user = $fixtures->getReference('user_user');
        $client->loginUser($user);

        $client->request('POST', '/avis/new/'. $conseilId,[
            'contenu' => 'une description',
        ]);

        $this->assertResponseIsSuccessful();
    }

}
