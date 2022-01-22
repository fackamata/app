<?php

namespace App\Tests\Functional;

use App\DataFixtures\AppFixtures;
// use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginFunctionalTest extends WebTestCase
{
    // use FixturesTrait;

    public function testShouldDisplayLogin(): void
    {
        $client = static::createClient();
        $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Connectez-vous');
    }

    public function testVisitingWhileLoggin(): void
    {
        $client = static::createClient();
        $fixtures = $this->loadFixtures([AppFixtures::class])->getReferenceRepository();

        $user = $fixtures->getReference('user_user');
        $client->loginUser($user);

        $client->request('GET', '/login');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('p', 'Vous êtes déjà connecté en tant que test');
    }

    public function testLoginWithBadCredential(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $buttonCrawlerNode = $crawler->selectButton('Connexion');
        $form = $buttonCrawlerNode->form(); 
        
        $form = $buttonCrawlerNode->form([
            'username' => 'false',
            'password' => 'fake', 
        ]);

        $client->submit($form);
        $this->assertResponseRedirects();
        $client->followRedirect();
        $this->assertSelectorTextContains('.alert.alert-danger', 'Invalid credentials.');
    }

}