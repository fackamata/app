<?php

namespace App\Tests\Functional;

use App\DataFixtures\AppFixtures;
// use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class AdminFunctionalTest extends WebTestCase
{
    // use FixturesTrait;

    public function testRedirectToLogin()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/admin');
        $this->assertResponseRedirects('/login');
    }

    public function testShouldDisplayAdmin()
    {
        
        $client = static::createClient();
        
        $fixtures = $this->loadFixtures([AppFixtures::class])->getReferenceRepository();

        $testUser = $fixtures->getReference('user_admin');        
        $client->loginUser($testUser);
        
        $client->request('GET', '/admin/');
        $this->assertResponseIsSuccessful();

    }

    public function testShouldDisplayAllAnnonce()
    {
        
        $client = static::createClient();
        
        $fixtures = $this->loadFixtures([AppFixtures::class])->getReferenceRepository();

        $testUser = $fixtures->getReference('user_admin');        
        $client->loginUser($testUser);
        
        $client->request('GET', '/admin/annonce');
        $this->assertResponseIsSuccessful();

    }

    public function testShouldDisplayAllConseil()
    {
        
        $client = static::createClient();
        
        $fixtures = $this->loadFixtures([AppFixtures::class])->getReferenceRepository();

        $testUser = $fixtures->getReference('user_admin');        
        $client->loginUser($testUser);
        
        $client->request('GET', '/admin/conseil');
        $this->assertResponseIsSuccessful();

    }

    public function testShouldDisplayAllAvis()
    {
        
        $client = static::createClient();
        
        $fixtures = $this->loadFixtures([AppFixtures::class])->getReferenceRepository();

        $testUser = $fixtures->getReference('user_admin');        
        $client->loginUser($testUser);
        
        $client->request('GET', '/admin/avis');
        $this->assertResponseIsSuccessful();

    }

    public function testShouldDisplayAllMessage()
    {
        
        $client = static::createClient();
        
        $fixtures = $this->loadFixtures([AppFixtures::class])->getReferenceRepository();

        $testUser = $fixtures->getReference('user_admin');        
        $client->loginUser($testUser);
        
        $client->request('GET', '/admin/message');
        $this->assertResponseIsSuccessful();

    }

    public function testShouldDisplayAllUser()
    {
        
        $client = static::createClient();
        
        $fixtures = $this->loadFixtures([AppFixtures::class])->getReferenceRepository();

        $testUser = $fixtures->getReference('user_admin');        
        $client->loginUser($testUser);
        
        $client->request('GET', '/admin/user');
        $this->assertResponseIsSuccessful();

    }
}

