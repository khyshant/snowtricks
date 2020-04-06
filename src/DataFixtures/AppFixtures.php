<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Group;
use App\Entity\Image;
use App\Entity\Trick;
use App\Entity\User;
use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;


class AppFixtures extends Fixture {
/**
* @var UserPasswordEncoderInterface
 */
private $userPasswordEncoder;

/**
 * @param UserPasswordEncoderInterface $UserPasswordEncoder
 * */
    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        for ($h=1; $h <= 2; $h++) {
            $group = new Group();
            $group->setName(sprintf("Group N°%d", $h));
            $group->setDescription(sprintf("Description Group N°%d", $h));
            $group->setDateAdd(date('Y-m-d H:i:s'));
            $manager->persist($group);
            $manager->flush();

            for ($i = 1; $i <= 2; $i++){
                $trickAuthor = new User();
                $trickAuthor->setUsername(sprintf("user%d_%d", $i,$h));
                $trickAuthor->setEmail(sprintf("user%d_%d@toto.fr", $i,$h));
                //$trickAuthor->setActivated(1);
                $trickAuthor->setPassword($this->userPasswordEncoder->encodePassword($trickAuthor,'userpass'));
                $manager->persist($trickAuthor);
                $manager->flush();

                for ($j = 1; $j <= 5; $j++) {
                    $trick = new Trick();
                    $trick->setTitle(sprintf("Saut N°%d_%d_%d", $h,$j,$i));
                    $trick->setSlug();
                    $trick->setDescription(sprintf("Description N°%d", $j));
                    $trick->setMetatitle(sprintf("Metatitle N°%d", $j));
                    $trick->setMetadescription(sprintf("Metadescription N°%d", $j));
                    $trick->setDescription(sprintf("description N°%d", $j));
                    $trick->setIsValid(rand(0, 1));
                    $trick->setAuthor($trickAuthor);
                    $trick->setGroup($group);

                    for ($k = 1; $k <= 2; $k++) {
                        $image = new Image();
                        $image->setPath("image.png");
                        $trick->addImage($image);
        //                $manager->persist($image);
                    }

                    for ($l = 1; $l <= 2; $l++) {
                        $video = new Video();
                        $video->setUri("video.mp4");
                        $trick->addVideo($video);
                        //                $manager->persist($image);
                        $manager->flush();
                    }
                    for ($m = 1; $m <= 10; $m++) {
                        $comment = new Comment();
                        $comment->setComment(sprintf("commentaire N°%d", $m));
                        $comment->setTrick($trick);
                        $comment->setIsValid(rand(0,1));

                        if($m <= 2){
                            $comment->setAuthor($trickAuthor);
                        }
                        else {
                            //Generate a random string.
                            $token = random_bytes(16);

                            //Convert the binary data into hexadecimal representation.
                            $token = bin2hex($token);
                            $author = new User();
                            $author->setUsername(sprintf("user%d_%s",$i, $token));
                            $author->setEmail(sprintf("user%d_%s@toto.fr", $i,$token));
                            //$author->setActivated(1);
                            $author->setPassword($this->userPasswordEncoder->encodePassword($author,'userpass'));
                            $manager->persist($author);
                            $manager->flush();
                            $comment->setAuthor($author);
                        }
                        $trick->addComment($comment);
                        $manager->persist($comment);
                    }
                    $trick->setSlug();
                    $manager->persist($trick);

                }
            }
        }

        $manager->flush();
    }
}
