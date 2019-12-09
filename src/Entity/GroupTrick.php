<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GroupTrickRepository")
 */
class GroupTrick
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_valid;

    /**
     * @var string|null
     * @var string A "Y-m-d H:i:s" formatted value
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime()
     */

    private $date_add;

    /**
     * @var string|null
     * @var string A "Y-m-d H:i:s" formatted value
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $date_upd;

    /*__________relations___________*/
    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="App\Entity\Trick", mappedBy="groupTricks")
     */
    private $tricks;
    private $trick;


    /*__________construc___________*/
    public function __construct(){
        $this->setDateAdd(date("Y-m-d H:i:s")) ;
        $this->setDateUpd(date("Y-m-d H:i:s")) ;
        $this->tricks = new ArrayCollection();
        $this->setIsValid(false) ;
    }

    /*__________getter and setter___________*/
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
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
    public function getDateUpd()
    {
        return $this->date_upd;
    }

    /**
     * @param mixed $date_upd
     */
    public function setDateUpd($date_upd): void
    {
        $this->date_upd = $date_upd;
    }

    /**
     * @return mixed
     */
    public function getTricks()
    {
        return $this->tricks;
    }

    public function addTrick(Trick $trick): self
    {
        if (!$this->tricks->contains($trick)) {
            $this->tricks[] = $trick;
            $trick->addGroupTrick($this);
        }

        return $this;
    }

    public function removeTrick(Trick $trick): self
    {
        if ($this->tricks->contains($trick)) {
            $this->tricks->removeElement($trick);
            $trick->removeGroupTrick($this);
        }

        return $this;
    }

    /**
     * @param mixed $tricks
     */
    public function setTricks($tricks): void
    {
        $this->tricks = $tricks;
    }

    /**
     * @return mixed
     */
    public function getisValid()
    {
        return $this->is_valid;
    }

    /**
     * @param mixed $is_valid
     */
    public function setIsValid($is_valid): void
    {
        $this->is_valid = $is_valid;
    }


}
