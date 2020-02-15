<?php

namespace App\Tests\Unit;

use App\Entity\Annonce;
use App\Entity\Conseil;
use App\Entity\Message;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $user = new User;
        $user->setUsername('pseudo')
            ->setPassword('123456')
            ->setNom('Dupond')
            ->setPrenom('gerard')
            ->setMail('test@gmail.com');

        $this->assertTrue($user->getUsername() === 'pseudo');
        $this->assertTrue($user->getPassword() === '123456');
        $this->assertTrue($user->getNom() === 'Dupond');
        $this->assertTrue($user->getPrenom() === 'gerard');
        $this->assertTrue($user->getMail() === 'test@gmail.com');
    }

    public function testIsFalse()
    {
        $user = new User;
        $user->setUsername('pseudo')
            ->setRoles(['test'])
            ->setPassword('123456')
            ->setNom('Dupond')
            ->setPrenom('gerard')
            ->setMail('test@gmail.com');

        $this->assertFalse($user->getUsername() === 'false');
        $this->assertFalse($user->getRoles() === ['false']);
        $this->assertFalse($user->getPassword() === 'false');
        $this->assertFalse($user->getNom() === 'false');
        $this->assertFalse($user->getPrenom() === 'false');
        $this->assertFalse($user->getMail() === 'false@gmail.com');
    }

    public function testIsEmpty()
    {
        $user = new User;
        $this->assertEmpty($user->getUsername());
        $this->assertEmpty($user->getUserIdentifier());
        $this->assertEmpty($user->getNom());
        $this->assertEmpty($user->getPrenom());
        $this->assertEmpty($user->getMail());
        $this->assertEmpty($user->getAnnonces());
        $this->assertEmpty($user->getId());

    }

    public function testIsNotEmpty()
    {
        $user = new User;
        $this->assertNotEmpty($user->getRoles());
        
    }

    public function testAddGetRoles()
    {
        $user = new User;
        $role = 'ROLE_OPERATOR';

        $this->assertNotContains($role, $user->getRoles());

        $user->addRoles($role);
        $this->assertContains($role, $user->getRoles());

    }

    public function testAddGetRemoveAnnonce()
    {
        $user = new User;
        $annonce = new Annonce;

        $this->assertEmpty($user->getAnnonces());

        $user->addAnnonce($annonce);
        $this->assertContains($annonce, $user->getAnnonces());

        $user->removeAnnonce($annonce);
        $this->assertEmpty($user->getAnnonces());
    }

    public function testAddGetRemoveConseil()
    {
        $user = new User;
        $conseil = new Conseil;

        $this->assertEmpty($user->getConseil());

        $user->addConseil($conseil);
        $this->assertContains($conseil, $user->getConseil());

        $user->removeConseil($conseil);
        $this->assertEmpty($user->getConseil());
    }

    public function testAddGetRemoveMessageRecu()
    {
        $user = new User;
        $message = new Message;

        $this->assertEmpty($user->getMessagesRecus());

        $user->addMessagesRecu($message);
        $this->assertContains($message, $user->getMessagesRecus());

        $user->removeMessagesRecu($message);
        $this->assertEmpty($user->getMessagesRecus());
    }

    public function testAddGetRemoveMessageEnvoye()
    {
        $user = new User;
        $message = new Message;

        $this->assertEmpty($user->getMessagesEnvoyes());

        $user->addMessagesEnvoye($message);
        $this->assertContains($message, $user->getMessagesEnvoyes());

        $user->removeMessagesEnvoye($message);
        $this->assertEmpty($user->getMessagesEnvoyes());
    }
}
