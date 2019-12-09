<?php

namespace App\DataFixtures;

use App\Entity\GroupTrick;
use App\Entity\Image;
use App\Entity\Trick;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=1; $i <= 5; $i++) {
            $groupTrick = new GroupTrick();
            $groupTrick->setName(sprintf("Groupe N°%d", $i));
            $groupTrick->setDescription(sprintf("Description Groupe N°%d", $i));
            $groupTrick->setDateAdd(date('Y-m-d H:i:s'));
            $manager->persist($groupTrick);


            for ($j = 1; $j <= 30; $j++) {
                $trick = new Trick();
                $trick->setTitle(sprintf("Saut N°%d", $i));
                $trick->setDescription(sprintf("Description N°%d", $i));
                $trick->setMetatitle(sprintf("Metatitle N°%d", $i));
                $trick->setMetadescription(sprintf("Metadescription N°%d", $i));
                $trick->setDescription(sprintf("description N°%d", $i));
                $trick->setIsValid(rand(0, 1));
                $trick->addGroupTrick($groupTrick);

                for ($k = 1; $k <= 10; $k++) {
                    $image = new Image();
                    $image->setPath("image.png");

                    $trick->addImage($image);
    //                $manager->persist($image);
                }

                $manager->persist($trick);
            }
        }

        $manager->flush();
    }
}
