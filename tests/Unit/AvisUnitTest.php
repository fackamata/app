<?php

namespace App\Tests\Unit;

use App\Entity\Avis;
use App\Entity\Conseil;
use App\Entity\User;
use DateTime;
use PHPUnit\Framework\TestCase;

class AvisUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $avis = new Avis;
        $dateTime = new DateTime;
        $user = new User;
        $conseil = new Conseil;

        $avis->setText('test')
            ->setDatePublication($dateTime)
            ->setUser($user)
            ->setConseil($conseil);

        $this->assertTrue($avis->getText() === 'test');
        $this->assertTrue($avis->getDatePublication() === $dateTime);
        $this->assertTrue($avis->getUser() === $user);
        $this->assertTrue($avis->getConseil() === $conseil);
    }

    public function testIsFalse()
    {
        $avis = new Avis;
        $dateTime = new DateTime;
        $user = new User;
        $conseil = new Conseil;

        $avis->setText('test')
            ->setDatePublication($dateTime)
            ->setUser($user)
            ->setConseil($conseil);

        $this->assertFalse($avis->getText() === 'false');
        $this->assertFalse($avis->getDatePublication() === 'false');
        $this->assertFalse($avis->getUser() === new User);
        $this->assertFalse($avis->getConseil() === new Conseil);
    }

    public function testIsEmpty()
    {
        $avis = new Avis;
        $this->assertEmpty($avis->getText());
        $this->assertEmpty($avis->getId());
        $this->assertEmpty($avis->getUser());
        $this->assertEmpty($avis->getConseil());
    }

    public function testIsNotEmpty()
    {
        $avis = new Avis;
        $this->assertNotEmpty($avis->getDatePublication());
    }
}
