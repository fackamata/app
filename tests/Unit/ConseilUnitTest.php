<?php

namespace App\Tests\Unit;

use App\Entity\Avis;
use App\Entity\Conseil;
use App\Entity\User;
use DateTime;
use PHPUnit\Framework\TestCase;

class ConseilUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $conseil = new Conseil;
        $dateTime = new DateTime();
        $user = new User();

        $conseil->setTitre('test')
            ->setDescription('description')
            ->setDatePublication($dateTime)
            ->setNombreVue(3)
            ->setPhoto('/lien')
            ->setUser($user);

        $this->assertTrue($conseil->getTitre() === 'test');
        $this->assertTrue($conseil->getDescription() === 'description');
        $this->assertTrue($conseil->getDatePublication() === $dateTime);
        $this->assertTrue($conseil->getNombreVue() === 3);
        $this->assertTrue($conseil->getPhoto() === '/lien');
        $this->assertTrue($conseil->getUser() === $user);
    }

    public function testIsFalse()
    {
        $conseil = new Conseil;
        $conseil->setTitre('test')
            ->setDescription('description')
            ->setDatePublication(new DateTime())
            ->setNombreVue(3)
            ->setPhoto('/lien')
            ->setUser(new User);

        $this->assertFalse($conseil->getTitre() === 'false');
        $this->assertFalse($conseil->getDescription() === 'false');
        $this->assertFalse($conseil->getDatePublication() === new DateTime());
        $this->assertFalse($conseil->getNombreVue() === false);
        $this->assertFalse($conseil->getPhoto() === '/false');
        $this->assertFalse($conseil->getUser() === new User);
    }

    public function testIsEmpty()
    {
        $conseil = new Conseil;
        $this->assertEmpty($conseil->getTitre());
        $this->assertEmpty($conseil->getDescription());
        $this->assertEmpty($conseil->getNombreVue());
        $this->assertEmpty($conseil->getPhoto());
        $this->assertEmpty($conseil->getId());
        $this->assertEmpty($conseil->getUser());
    }

    public function testIsNotEmpty()
    {
        $conseil = new Conseil;
        $this->assertNotEmpty($conseil->getDatePublication());
    }

    public function testAddGetRemoveAvis()
    {
        $conseil = new Conseil;
        $avis = new Avis;

        $this->assertEmpty($conseil->getAvis());

        $conseil->addAvi($avis);
        $this->assertContains($avis, $conseil->getAvis());

        $conseil->removeAvi($avis);
        $this->assertEmpty($conseil->getAvis());
    }
    
}
