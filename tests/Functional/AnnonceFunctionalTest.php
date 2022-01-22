<?php

namespace App\Tests\Functional;

use App\DataFixtures\AppFixtures;
use App\Entity\Annonce;
use App\Form\AnnonceType;
use App\Repository\UserRepository;
// // use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AnnonceFunctionalTest extends WebTestCase
{
    // use FixturesTrait;

    public function testShouldDisplayAnnonceIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertSelectorTextContains('h1', 'Les annonces');
    }

    public function testShouldDisplayOneAnnonce()
    {
        $client = static::createClient();
        $fixtures = $this->loadFixtures([AppFixtures::class])->getReferenceRepository();

        $annonce = $fixtures->getReference('annonce_test');
        $client->request('GET', '/annonce/'.$annonce->getId());

        $this->assertResponseIsSuccessful();
    }

    public function testShouldCreateNewAnnonce()
    {
        $client = static::createClient();
        $fixtures = $this->loadFixtures([AppFixtures::class])->getReferenceRepository();

        $user = $fixtures->getReference('user_user');
        $client->loginUser($user);

        $client->request('POST', '/annonce/new',[
            'titre' => 'titre de test',
            'description' => 'une description',
            'type' => $fixtures->getReference('type_1'),
            'ville' => 'paris', 
            'file' => null            
        ]);

        $this->assertResponseIsSuccessful();
    }

}
