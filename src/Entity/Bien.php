<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BienRepository")
 */
class Bien
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $nombien;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Typebien")
     */
    private $typebien;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Localite")
     */
    private $localite;


        /**
         * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="bien")
         */
        private $images;

         /**
         * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="bien")
         */
        private $reservation;

        /**
         * @ORM\OneToMany(targetEntity="App\Entity\Contrat", mappedBy="bien")
         */
        private $contrat;




    public function getId()
    {
        return $this->id;
    }

    public function getNombien(): ?string
    {
        return $this->nombien;
    }

    public function setNombien(string $nombien): self
    {
        $this->nombien = $nombien;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEtat(): ?int
    {
        return $this->etat;
    }

    public function setEtat(int $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get the value of typebien
     */ 
    public function getTypebien()
    {
        return $this->typebien;
    }

    /**
     * Set the value of typebien
     *
     * @return  self
     */ 
    public function setTypebien($typebien)
    {
        $this->typebien = $typebien;

        return $this;
    }

    /**
     * Get the value of localite
     */ 
    public function getLocalite()
    {
        return $this->localite;
    }

    /**
     * Set the value of localite
     *
     * @return  self
     */ 
    public function setLocalite($localite)
    {
        $this->localite = $localite;

        return $this;
    }

    /**
     * Get the value of images
     */ 
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set the value of images
     *
     * @return  self
     */ 
    public function setImages($images)
    {
        $this->images = $images;

        return $this;
    }
}
