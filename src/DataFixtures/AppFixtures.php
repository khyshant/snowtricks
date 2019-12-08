<?php

namespace App\DataFixtures;

use App\Entity\Trick;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 100; $i++) {
            $trick = new Trick();
            $trick->setTitle(sprintf("Saut N°%d", $i));
            $trick->setDescription(sprintf("Description N°%d", $i));
            $trick->setMetatitle(sprintf("Metatitle N°%d", $i));
            $trick->setMetadescription(sprintf("Metadescription N°%d", $i));
            $trick->setDescription(sprintf("description N°%d", $i));
            $trick->setIsValid(rand(0,1));

            for ($j = 1; $j <= 10; $j++) {
                $image = new Image();
                $image->setPath("image.png");

                $trick->addImage($image);
//                $manager->persist($image);
            }

            $manager->persist($trick);
        }

        $manager->flush();
    }
}
