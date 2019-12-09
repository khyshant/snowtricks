<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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

    private $name;
    private $description;
    private $valid;
    private $date_add;
    private $date_upd;

    /*__________relations___________*/
    private $tricks;


    /*__________construc___________*/
    public function __construct(){
        $this->setDateAdd(date("Y-m-d H:i:s")) ;
        $this->setDateUpdate(date("Y-m-d H:i:s")) ;
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
    public function getValid()
    {
        return $this->valid;
    }

    /**
     * @param mixed $valid
     */
    public function setValid($valid): void
    {
        $this->valid = $valid;
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

    /**
     * @param mixed $tricks
     */
    public function setTricks($tricks): void
    {
        $this->tricks = $tricks;
    }


}
