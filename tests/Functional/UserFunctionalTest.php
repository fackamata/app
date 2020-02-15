<?php

namespace App\tests\Functional;

use App\DataFixtures\AppFixtures;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserFunctionalTest extends WebTestCase
{
    use FixturesTrait;

    public function testShouldDisplayOneUser()
    {
        $client = static::createClient();
        
        $fixtures = $this->loadFixtures([AppFixtures::class])->getReferenceRepository();

        $testUser = $fixtures->getReference('user_admin');        
        $client->loginUser($testUser);
        
        $client->request('GET', '/admin/user/3');
        $this->assertResponseIsSuccessful();
    }


    public function testShouldEditUser()
    {
        $client = static::createClient();
        $fixtures = $this->loadFixtures([AppFixtures::class])->getReferenceRepository();

        $user = $fixtures->getReference('user_user');
        $userId = $user->getId();
        $admin = $fixtures->getReference('user_admin');
        $client->loginUser($admin);

        $client->request('POST', '/admin/user/'. $userId . '/edit',[
            'nom' => 'paul'
        ]);

        $this->assertResponseIsSuccessful();
    }

}