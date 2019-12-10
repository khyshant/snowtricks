<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(type="text")
     */
    private $comment;

    /**
     * @var boolean|null
     * @ORM\Column(type="boolean")
     */
    private $is_valid;
    /**
     * @var string
     * @var string A "Y-m-d H:i:s" formatted value
     * @ORM\Column(type="string", nullable=true)
     */
    private $date_add;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Trick", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $trick;

    private $author;

    /*__________construc___________*/
    public function __construct(){
        $this->setDateAdd(date("Y-m-d H:i:s")) ;
        $this->setIsValid(false) ;
    }

    /*__________getter and setter___________*/

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @param null|string $comment
     */
    public function setComment(?string $comment): void
    {
        $this->comment = $comment;
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
    public function getTrick()
    {
        return $this->trick;
    }

    /**
     * @param mixed $trick
     */
    public function setTrick($trick): void
    {
        $this->trick = $trick;
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





}
