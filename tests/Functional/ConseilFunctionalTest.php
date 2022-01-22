<?php

namespace App\Tests\Functional;

use App\DataFixtures\AppFixtures;
// use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConseilFunctionalTest extends WebTestCase
{
    // use FixturesTrait;

    public function testShouldDisplayConseilIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/conseil/');
        $this->assertSelectorTextContains('h1', 'Les conseils');
    }

    public function testShouldDisplayOneConseil()
    {
        $client = static::createClient();
        $fixtures = $this->loadFixtures([AppFixtures::class])->getReferenceRepository();

        $conseil = $fixtures->getReference('conseil_2');
        $client->request('GET', '/conseil/show/'.$conseil->getId());

        $this->assertResponseIsSuccessful();
    }

    public function testShouldCreateNewConseil()
    {
        $client = static::createClient();
        $fixtures = $this->loadFixtures([AppFixtures::class])->getReferenceRepository();

        $user = $fixtures->getReference('user_user');
        $client->loginUser($user);

        $client->request('POST', '/conseil/new',[
            'titre' => 'titre de conseil',
            'description' => 'une description',
            'file' => null            
        ]);

        $this->assertResponseIsSuccessful();
    }

    public function testShouldEditConseil()
    {
        $client = static::createClient();
        $fixtures = $this->loadFixtures([AppFixtures::class])->getReferenceRepository();

        $conseil = $fixtures->getReference('conseil_3');
        $conseilId = $conseil->getId();
        $user = $fixtures->getReference('user_user');
        $client->loginUser($user);

        $client->request('POST', '/conseil/'. $conseilId . '/edit',[
            'titre' => 'new titre de conseil',
            'description' => 'new une description',
            'file' => null            
        ]);

        $this->assertResponseIsSuccessful();
    }

}
