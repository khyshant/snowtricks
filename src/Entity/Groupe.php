<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GroupeRepository")
 */
class Groupe
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
    private $isValid;

    /**
     * @var \DateTime|null
     * @ORM\Column(type="datetime", nullable=true)
     */

    private $date_add;

    /**
     * @var \DateTime|null
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_upd;



    /*__________construc___________*/
    public function __construct(){
        $this->setDateAdd(date("Y-m-d H:i:s")) ;
        $this->setDateUpd(date("Y-m-d H:i:s")) ;
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
        $this->date_add = new \DateTime();
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
        $this->date_upd = new \DateTime();
    }

    /**
     * @return Collection|Trick[]
     */

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
        return $this->isValid;
    }

    /**
     * @param mixed $isValid
     */
    public function setIsValid($isValid): void
    {
        $this->isValid = $isValid;
    }


}
