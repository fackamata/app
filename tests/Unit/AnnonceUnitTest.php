<?php

namespace App\Tests\Unit;

use App\Entity\Annonce;
use App\Entity\Message;
use App\Entity\Type;
use App\Entity\User;
use DateTime;
use PHPUnit\Framework\TestCase;

class AnnonceUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $annonce = new Annonce;
        $dateTime = new DateTime();
        $user = new User();
        $type = new Type();

        $annonce->setTitre('test')
            ->setDescription('description')
            ->setDatePublication($dateTime)
            ->setNombreVue(3)
            ->setType($type)
            ->setPhoto('/lien')
            ->setUser($user)
            ->setVille('thonon');

        $this->assertTrue($annonce->getTitre() === 'test');
        $this->assertTrue($annonce->getDescription() === 'description');
        $this->assertTrue($annonce->getDatePublication() === $dateTime);
        $this->assertTrue($annonce->getNombreVue() === 3);
        $this->assertTrue($annonce->getType() === $type);
        $this->assertTrue($annonce->getUser() === $user);
        $this->assertTrue($annonce->getPhoto() === '/lien');
        $this->assertTrue($annonce->getVille() === 'thonon');
    }

    public function testIsFalse()
    {
        $annonce = new Annonce;
        $annonce->setTitre('test')
            ->setDescription('description')
            ->setDatePublication(new DateTime())
            ->setNombreVue(3)
            ->setType(new Type)
            ->setPhoto('/lien')
            ->setUser(new User)
            ->setVille('thonon');

        $this->assertFalse($annonce->getTitre() === 'false');
        $this->assertFalse($annonce->getDescription() === 'false');
        $this->assertFalse($annonce->getDatePublication() === new DateTime());
        $this->assertFalse($annonce->getNombreVue() === false);
        $this->assertFalse($annonce->getType() === new Type);
        $this->assertFalse($annonce->getUser() === new User);
        $this->assertFalse($annonce->getPhoto() === '/false');
        $this->assertFalse($annonce->getVille() ==='annecy');
    }

    public function testIsEmpty()
    {
        $annonce = new Annonce;
        $this->assertEmpty($annonce->getTitre());
        $this->assertEmpty($annonce->getDescription());
        $this->assertEmpty($annonce->getNombreVue());
        $this->assertEmpty($annonce->getType());
        $this->assertEmpty($annonce->getUser());
        $this->assertEmpty($annonce->getPhoto());
        $this->assertEmpty($annonce->getId());
        $this->assertEmpty($annonce->getVille());
    }

    public function testIsNotEmpty()
    {
        $annonce = new Annonce;
        $this->assertNotEmpty($annonce->getDatePublication());
        $this->assertNotEmpty($annonce->getFileDirectory());
    }

    public function testAddGetRemoveMessage()
    {
        $annonce = new Annonce;
        $message = new Message;

        $this->assertEmpty($annonce->getMessages());

        $annonce->addMessage($message);
        $this->assertContains($message, $annonce->getMessages());

        $annonce->removeMessage($message);
        $this->assertEmpty($annonce->getMessages());
    }
}
