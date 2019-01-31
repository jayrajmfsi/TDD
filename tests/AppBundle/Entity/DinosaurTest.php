<?php

namespace Tests\AppBundle\Entity;

use PHPUnit\Framework\TestCase;
use AppBundle\Entity\Dinosaur;

class DinosaurTest extends TestCase
{
    public function testSettingLength()
    {
        $din = new Dinosaur();

        $this->assertSame(0, $din->getLength());

        $din->setLength(9);
        $this->assertSame(9, $din->getLength());
    }

    public function testDinosaurNotShrunk()
    {
        $din = new Dinosaur();

        $din->setLength(15);

        $this->assertGreaterThan(12, $din->getLength(), 'Did you put something wrong in setting');
    }

    public function testReturnsFullSpecificationOfDinosaur()
    {
        $dinosaur = new Dinosaur();
        $this->assertSame(
            'The Unknown non-carnivorous dinosaur is 0 meters long',
            $dinosaur->getSpecification()
        );
    }

    public function testReturnsFullSpecificationForTyrannosaurus()
    {
        $dinosaur = new Dinosaur('Tyrannosaurus', true);
        $dinosaur->setLength(12);
        $this->assertSame(
            'The Tyrannosaurus carnivorous dinosaur is 12 meters long',
            $dinosaur->getSpecification()
        );
    }
}