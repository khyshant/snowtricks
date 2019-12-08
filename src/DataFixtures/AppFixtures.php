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
            $trick->setTitle(sprintf("saut N°%d", $i));
            $trick->setContent("Content");

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
