<?php

namespace App\Tests\Unit;

use App\Entity\Annonce;
use App\Entity\Type;
use PHPUnit\Framework\TestCase;

class TypeUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $type = new Type;
        $type->setNom('test');

        $this->assertTrue($type->getNom() === 'test');
    }

    public function testIsFalse()
    {
        $type = new Type;
        $type->setNom('test');

        $this->assertFalse($type->getNom() === 'false');
    }

    public function testIsEmpty()
    {
        $type = new Type;
        $this->assertEmpty($type->getNom());
        $this->assertEmpty($type->getId());
    }

    public function testAddGetRemoveAnnonce()
    {
        $type = new Type;
        $annonce = new Annonce;

        $this->assertEmpty($type->getAnnonces());

        $type->addAnnonce($annonce);
        $this->assertContains($annonce, $type->getAnnonces());

        $type->removeAnnonce($annonce);
        $this->assertEmpty($type->getAnnonces());
    }
    
}
