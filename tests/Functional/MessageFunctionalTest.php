<?php

namespace App\Tests\Functional;

use App\DataFixtures\AppFixtures;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MessageFunctionalTest extends WebTestCase
{
    use FixturesTrait;

    public function testShouldDisplayOneMessage()
    {
        $client = static::createClient();
        $fixtures = $this->loadFixtures([AppFixtures::class])->getReferenceRepository();

        $user = $fixtures->getReference('user_admin');
        $client->loginUser($user);
        $message = $fixtures->getReference('message_2');
        $client->request('GET', '/message/'.$message->getId());

        $this->assertResponseIsSuccessful();
    }

    public function testShouldCreateNewMessage()
    {
        $client = static::createClient();
        $fixtures = $this->loadFixtures([AppFixtures::class])->getReferenceRepository();

        $annonce = $fixtures->getReference('annonce_4');
        $annonceId = $annonce->getId();
        $destinatairId = $annonce->getUser()->getId();
        $sender = $fixtures->getReference('user_user');
        $senderId= $sender->getId();
        $client->loginUser($sender);

        $client->request('POST', '/message/new/' .$annonceId. '/' .$destinatairId. '/' .$senderId ,[
            'contenu' => 'new message',         
        ]);

        $this->assertResponseIsSuccessful();
    }
    
    // public function testShouldCreateNewConseil()
    // {
    //     $client = static::createClient();
    //     $fixtures = $this->loadFixtures([AppFixtures::class])->getReferenceRepository();

    //     $user = $fixtures->getReference('user_user');
    //     $client->loginUser($user);

    //     $client->request('POST', '/conseil/new',[
    //         'titre' => 'titre de conseil',
    //         'description' => 'une description',
    //         'file' => null            
    //     ]);

    //     $this->assertResponseIsSuccessful();
    // }

    // public function testShouldEditConseil()
    // {
    //     $client = static::createClient();
    //     $fixtures = $this->loadFixtures([AppFixtures::class])->getReferenceRepository();

    //     $conseil = $fixtures->getReference('conseil_3');
    //     $conseilId = $conseil->getId();
    //     $user = $fixtures->getReference('user_user');

    //     $client->request('POST', '/conseil/'. $conseilId . '/edit',[
    //         'titre' => 'new titre de conseil',
    //         'description' => 'new une description',
    //         'file' => null            
    //     ]);

    //     $this->assertResponseIsSuccessful();
    // }

}
