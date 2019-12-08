<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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

    /**
     * @var string|null
     * @ORM\Column(type="string", lenght="255" )
     * @Assert\NotBlank
     */
    private $title;

    /**
     * @var string|null
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @var string|null
     * @ORM\Column(type="string", lenght="255" )
     */
    private $metatitle;

    /**
     * @var string|null
     * @ORM\Column(type="text")
     */
    private $metadescription;

    /**
     * @var boolean|null
     * @ORM\Column(type="boolean")
     */
    private $is_valid;

    /**
     * @var string
     * @var string A "Y-m-d H:i:s" formatted value
     * @Assert\DateTime()
     */
    private $date_add;

    /**
     * @var string
     * @var string A "Y-m-d H:i:s" formatted value
     * @Assert\DateTime()
     */
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
