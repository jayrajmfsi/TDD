<?php

namespace Tests\AppBundle\Factory;

use AppBundle\Entity\Dinosaur;
use AppBundle\Service\DinosaurLengthDeterminator;
use PHPUnit\Framework\TestCase;
use AppBundle\Factory\DinosaurFactory;

class DinosaurFactoryTest extends TestCase
{
    /** @var DinosaurFactory */
    private $factory;
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $lengthDeterminator;

    public function setUp()
    {
        $this->lengthDeterminator = $this->createMock(DinosaurLengthDeterminator::class);
        $this->factory = new DinosaurFactory($this->lengthDeterminator);
    }

    public function testItGrowsALargeVelociraptor()
    {
        $dinosaur = $this->factory->growVelociraptor(5);

        $this->assertInstanceOf(Dinosaur::class, $dinosaur);
        $this->assertInternalType('string', $dinosaur->getGenus());
        $this->assertSame('Velociraptor', $dinosaur->getGenus());
        $this->assertSame(5, $dinosaur->getLength());
    }

//    public function testItGrowsATriceraptors()
//    {
//        $this->markTestIncomplete('Waiting for confirmation from GenLab');
//    }
//
//    public function testItGrowsABabyVelociraptor()
//    {
//        if (!class_exists('Nanny')) {
//            $this->markTestSkipped('There is nobody to watch the baby!');
//        }
//    }

    /**
     * @dataProvider getSpecificationTests
     */
    public function testItGrowsADinosaurFromSpecification(string $spec, bool $expectedIsCarnivorous)
    {
        $this->lengthDeterminator->expects($this->once())
            ->method('getLengthFromSpecification')
            ->with($spec)->willReturn(20)
        ;

        $dinosaur = $this->factory->growFromSpecification($spec);

//        if ($expectedIsLarge) {
//            $this->assertGreaterThanOrEqual(Dinosaur::LARGE, $dinosaur->getLength());
//        } else {
//            $this->assertLessThan(Dinosaur::LARGE, $dinosaur->getLength());
//        }
        $this->assertSame(20, $dinosaur->getLength());
        $this->assertSame($expectedIsCarnivorous ,$dinosaur->isCarnivorous(), 'Diets do not match');
    }

    public function getSpecificationTests()
    {
        return [
            // specification, is large, is carnivorous
            ['large carnivorous dinosaur', true],
            'default response' => ['give me all the cookies!!!', false],
            ['large herbivore', false]
        ];
    }

//    /**
//     * @dataProvider getHugeDinosaurSpecTests
//     */
//    public function testItGrowsAHugeDinosaur(string $specification)
//    {
//        $dinosaur = $this->factory->growFromSpecification($specification);
//        $this->assertGreaterThanOrEqual(Dinosaur::HUGE, $dinosaur->getLength());
//    }
//
//    public function getHugeDinosaurSpecTests()
//    {
//        return [
//            ['huge dinosaur'],
//            ['huge dino'],
//            ['huge'],
//            ['OMG'],
//            ['😱'],
//        ];
//    }
}