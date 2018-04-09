<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProprietaireRepository")
 */
class Proprietaire
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
    private $nomprop;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $numpiece;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $adresse;

    /**
     * @ORM\Column(type="integer")
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $codebanque;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $email;

    public function getId()
    {
        return $this->id;
    }

    public function getNomprop(): ?string
    {
        return $this->nomprop;
    }

    public function setNomprop(string $nomprop): self
    {
        $this->nomprop = $nomprop;

        return $this;
    }

    public function getNumpiece(): ?string
    {
        return $this->numpiece;
    }

    public function setNumpiece(string $numpiece): self
    {
        $this->numpiece = $numpiece;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getCodebanque(): ?string
    {
        return $this->codebanque;
    }

    public function setCodebanque(string $codebanque): self
    {
        $this->codebanque = $codebanque;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
