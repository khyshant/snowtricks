<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrickRepository")
 */
class Trick
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    private $title;
    private $description;
    private $metatitle;
    private $metadescription;
    private $is_valid;
    private $date_add;
    private $date_update;
    /*__________relations___________*/
    private $author;
    private $groupTricks;
    private $comments;
    private $images;
    private $videos;

    /*__________getter and setter___________*/
    public function getId(): ?int
    {
        return $this->id;
    }
}
