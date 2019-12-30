<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Group;
use App\Entity\Image;
use App\Entity\Trick;
use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=1; $i <= 5; $i++) {
            $group = new Group();
            $group->setName(sprintf("Group N°%d", $i));
            $group->setDescription(sprintf("Description Group N°%d", $i));
            $group->setDateAdd(date('Y-m-d H:i:s'));
            $manager->persist($group);
            $manager->flush();

            for ($j = 1; $j <= 30; $j++) {
                $trick = new Trick();
                $trick->setTitle(sprintf("Saut N°%d_%d", $i,$j));
                $trick->setDescription(sprintf("Description N°%d", $j));
                $trick->setMetatitle(sprintf("Metatitle N°%d", $j));
                $trick->setMetadescription(sprintf("Metadescription N°%d", $j));
                $trick->setDescription(sprintf("description N°%d", $j));
                $trick->setIsValid(rand(0, 1));
                $trick->setGroup($group);
                $manager->persist($trick);
                $trick->setSlug();

                for ($k = 1; $k <= 10; $k++) {
                    $image = new Image();
                    $image->setPath("image.png");
                    $trick->addImage($image);
    //                $manager->persist($image);
                }

                for ($l = 1; $l <= 10; $l++) {
                    $video = new Video();
                    $video->setUri("video.mp4");
                    $trick->addVideo($video);
                    //                $manager->persist($image);
                }
                for ($m = 1; $m <= 30; $m++) {
                    $comment = new Comment();
                    $comment->setComment(sprintf("commentaire N°%d", $m));
                    $comment->setTrick($trick);
                    $comment->setIsValid(rand(0,1));

                    $trick->addComment($comment);
                    $manager->persist($comment);
                }

                $manager->persist($trick);
                $trick->setSlug();
            }
        }

        $manager->flush();
    }
}
