<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
    /*__________construc___________*/
    public function __construct(){
        $this->setDateAdd(date("Y-m-d H:i:s")) ;
        $this->setDateUpdate(date("Y-m-d H:i:s")) ;
        $this->images = new ArrayCollection();
    }

    /*__________getter and setter___________*/
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param null|string $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return null|string
     */
    public function getMetatitle(): ?string
    {
        return $this->metatitle;
    }

    /**
     * @param null|string $metatitle
     */
    public function setMetatitle(?string $metatitle): void
    {
        $this->metatitle = $metatitle;
    }

    /**
     * @return null|string
     */
    public function getMetadescription(): ?string
    {
        return $this->metadescription;
    }

    /**
     * @param null|string $metadescription
     */
    public function setMetadescription(?string $metadescription): void
    {
        $this->metadescription = $metadescription;
    }

    /**
     * @return bool|null
     */
    public function getisValid(): ?bool
    {
        return $this->is_valid;
    }

    /**
     * @param bool|null $is_valid
     */
    public function setIsValid(?bool $is_valid): void
    {
        $this->is_valid = $is_valid;
    }

    /**
     * @return mixed
     */
    public function getDateAdd()
    {
        return $this->date_add;
    }

    /**
     * @param mixed $date_add
     */
    public function setDateAdd($date_add): void
    {
        $this->date_add = $date_add;
    }

    /**
     * @return mixed
     */
    public function getDateUpdate()
    {
        return $this->date_update;
    }

    /**
     * @param mixed $date_update
     */
    public function setDateUpdate($date_update): void
    {
        $this->date_update = $date_update;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getGroupTricks()
    {
        return $this->groupTricks;
    }

    /**
     * @param mixed $groupTricks
     */
    public function setGroupTricks($groupTricks): void
    {
        $this->groupTricks = $groupTricks;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments): void
    {
        $this->comments = $comments;
    }

    /**
     * @return Collection
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    /**
     * @param Image $image
     */
    public function addImage(Image $image)
    {
        $image->setTrick($this);
        $this->images->add($image);
    }

    public function removeImage(Image $image)
    {
        $image->setTrick(null);
        $this->images->removeElement($image);
    }

    /**
     * @param Collection $images
     */
    public function setImages(Collection $images): void
    {
        $this->images = $images;
    }

    /**
     * @return mixed
     */
    public function getVideos()
    {
        return $this->videos;
    }

    /**
     * @param mixed $videos
     */
    public function setVideos($videos): void
    {
        $this->videos = $videos;
    }


}
