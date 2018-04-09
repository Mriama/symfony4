<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client
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
    private $numeropiece;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $nomclient;

    /**
     * @ORM\Column(type="integer")
     */
    private $telclient;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $adressclient;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $mailclient;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $password;

     /**
         * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="client")
         */
        private $reservation;

         /**
         * @ORM\OneToMany(targetEntity="App\Entity\Contrat", mappedBy="client")
         */
        private $contrat;

    public function getId()
    {
        return $this->id;
    }

    public function getNumeropiece(): ?string
    {
        return $this->numeropiece;
    }

    public function setNumeropiece(string $numeropiece): self
    {
        $this->numeropiece = $numeropiece;

        return $this;
    }

    public function getNomclient(): ?string
    {
        return $this->nomclient;
    }

    public function setNomclient(string $nomclient): self
    {
        $this->nomclient = $nomclient;

        return $this;
    }

    public function getTelclient(): ?int
    {
        return $this->telclient;
    }

    public function setTelclient(int $telclient): self
    {
        $this->telclient = $telclient;

        return $this;
    }

    public function getAdressclient(): ?string
    {
        return $this->adressclient;
    }

    public function setAdressclient(string $adressclient): self
    {
        $this->adressclient = $adressclient;

        return $this;
    }

    public function getMailclient(): ?string
    {
        return $this->mailclient;
    }

    public function setMailclient(string $mailclient): self
    {
        $this->mailclient = $mailclient;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
