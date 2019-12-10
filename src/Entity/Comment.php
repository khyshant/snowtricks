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
     * @var string
     * @var string A "Y-m-d H:i:s" formatted value
     * @ORM\Column(type="string", nullable=true)
     */
    private $date_add;

    /**
     * @var string
     * @var string A "Y-m-d H:i:s" formatted value
     * @ORM\Column(type="string", nullable=true)
     */
    private $date_valid;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Trick", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $trick;

    private $author;

    /*__________construc___________*/
    public function __construct(){

    }

    /*__________getter and setter___________*/

    public function getId(): ?int
    {
        return $this->id;
    }





}
