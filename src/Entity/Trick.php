<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="string")
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
     * @ORM\Column(type="string" )
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

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Image", mappedBy="post", orphanRemoval=true, cascade={"persist"})
     * @Assert\Count(min=1)
     * @Assert\Valid
     */
    private $images;

    private $videos;

    /*__________getter and setter___________*/
    public function getId(): ?int
    {
        return $this->id;
    }
}
