<?php

namespace App\Tests\Unit;

use App\Entity\Annonce;
use App\Entity\Message;
use App\Entity\User;
use DateTime;
use PHPUnit\Framework\TestCase;

class MessageUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $message = new Message;
        $dateTime = new DateTime();
        $destinataire = new User;
        $sender = new User;
        $annonce = new Annonce;

        $message->setContenu('test')
            ->setDate($dateTime)
            ->setLu(true)
            ->setDestinataire($destinataire)
            ->setSender($sender)
            ->setAnnonce($annonce);

        $this->assertTrue($message->getContenu() === 'test');
        $this->assertTrue($message->getDate() === $dateTime);
        $this->assertTrue($message->getLu() === true);
        $this->assertTrue($message->getDestinataire() === $destinataire);
        $this->assertTrue($message->getSender() === $sender);
        $this->assertTrue($message->getAnnonce() === $annonce);
    }

    public function testIsFalse()
    {
        $message = new Message;
        $destinataire = new User;
        $sender = new User;
        $annonce = new Annonce;

        $message->setContenu('test')
            ->setDate(new DateTime())
            ->setLu(true)
            ->setDestinataire($destinataire)
            ->setSender($sender)
            ->setAnnonce($annonce);

        $this->assertFalse($message->getContenu() === 'false');
        $this->assertFalse($message->getDate() === new DateTime());
        $this->assertFalse($message->getLu() === false);
        $this->assertFalse($message->getDestinataire() === $sender);
        $this->assertFalse($message->getSender() === $destinataire);
        $this->assertFalse($message->getAnnonce() === new Annonce);
    }

    public function testIsEmpty()
    {
        $message = new Message;
        $this->assertEmpty($message->getContenu());
        $this->assertEmpty($message->getLu());
        $this->assertEmpty($message->getId());
        $this->assertEmpty($message->getDestinataire());
        $this->assertEmpty($message->getSender());
        $this->assertEmpty($message->getAnnonce());
    }

    public function testIsNotEmpty()
    {
        $message = new Message;
        $this->assertNotEmpty($message->getDate());
    }
}
