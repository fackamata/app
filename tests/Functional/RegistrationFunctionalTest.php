<?php

namespace App\Tests\Functional;

use App\DataFixtures\AppFixtures;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationFunctionalTest extends WebTestCase
{
    use FixturesTrait;

    public function testShouldDisplayCreateAccount(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Créer un compte');
    }

    public function testShouldDisplayMonCompte()
    {
        
        $client = static::createClient();
        
        $fixtures = $this->loadFixtures([AppFixtures::class])->getReferenceRepository();

        $testUser = $fixtures->getReference('user_user');        
        $client->loginUser($testUser);
        $clientId = $testUser->getId();
        
        $client->request('GET', '/register/'.$clientId);
        $this->assertResponseIsSuccessful();

    }
   
    public function testShouldRedirectOtherUser()
    {        
        $client = static::createClient();
        
        $fixtures = $this->loadFixtures([AppFixtures::class])->getReferenceRepository();

        $testUser = $fixtures->getReference('user_user');        
        $client->loginUser($testUser);
        $clientId = $testUser->getId();
        
        $client->request('GET', '/register/'.$clientId+1);
        $this->assertResponseRedirects();

    }

    public function testShoulDisplayAnnonceByUser()
    {        
        $client = static::createClient();
        
        $fixtures = $this->loadFixtures([AppFixtures::class])->getReferenceRepository();

        $testUser = $fixtures->getReference('user_user');        
        $client->loginUser($testUser);
        $clientId = $testUser->getId();
        
        $client->request('GET', '/register/annonce/'.$clientId);
        $this->assertResponseIsSuccessful();

    }

    public function testShoulDisplayConseilByUser()
    {        
        $client = static::createClient();
        
        $fixtures = $this->loadFixtures([AppFixtures::class])->getReferenceRepository();

        $testUser = $fixtures->getReference('user_user');        
        $client->loginUser($testUser);
        $clientId = $testUser->getId();
        
        $client->request('GET', '/register/conseil/'.$clientId);
        $this->assertResponseIsSuccessful();

    }

    public function testShoulDisplayAvisByUser()
    {        
        $client = static::createClient();
        
        $fixtures = $this->loadFixtures([AppFixtures::class])->getReferenceRepository();

        $testUser = $fixtures->getReference('user_user');        
        $client->loginUser($testUser);
        $clientId = $testUser->getId();
        
        $client->request('GET', '/register/avis/'.$clientId);
        $this->assertResponseIsSuccessful();

    }

    public function testShoulDisplayMessageRecuByUser()
    {        
        $client = static::createClient();
        
        $fixtures = $this->loadFixtures([AppFixtures::class])->getReferenceRepository();

        $testUser = $fixtures->getReference('user_user');        
        $client->loginUser($testUser);
        $clientId = $testUser->getId();
        
        $client->request('GET', '/register/message/'.$clientId);
        $this->assertResponseIsSuccessful();

    }

    public function testShoulDisplayMessageEnvoyeByUser()
    {        
        $client = static::createClient();
        
        $fixtures = $this->loadFixtures([AppFixtures::class])->getReferenceRepository();

        $testUser = $fixtures->getReference('user_user');        
        $client->loginUser($testUser);
        $clientId = $testUser->getId();
        
        $client->request('GET', '/register/message/envoye/'.$clientId);
        $this->assertResponseIsSuccessful();

    }

 
}