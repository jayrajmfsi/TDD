<?php

namespace AppBundle\Factory;

use AppBundle\Entity\Dinosaur;
use AppBundle\Service\DinosaurLengthDeterminator;

class DinosaurFactory
{
    private $lengthDeterminator;

    /**
     * DinosaurFactory constructor.
     * @param DinosaurLengthDeterminator $lengthDeterminator
     */
    public function __construct(DinosaurLengthDeterminator $lengthDeterminator)
    {
        $this->lengthDeterminator = $lengthDeterminator;
    }

    public function growVelociraptor(int $length): Dinosaur
    {
//        $dinosaur = new Dinosaur('Velociraptor', true);
//        $dinosaur->setLength($length);
//        return $dinosaur;
        return $this->createDinosaur('Velociraptor', true, $length);

    }

    public function growFromSpecification(string $specification): Dinosaur
    {
        $codeName = 'InG-' . random_int(1, 99999);
        $isCarnivorous = false;

        $length = $this->lengthDeterminator->getLengthFromSpecification($specification);


        if (stripos($specification, 'carnivorous') !== false) {
            $isCarnivorous = true;
        }
        $dinosaur = $this->createDinosaur($codeName, $isCarnivorous, $length);
        return $dinosaur;
    }

    private function createDinosaur(string $genus, bool $isCarnivorous, int $length)
    {
        $dinosaur = new Dinosaur($genus, $isCarnivorous);
        $dinosaur->setLength($length);

        return $dinosaur;
    }
}