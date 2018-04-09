<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datereserv;

    /**
     * @ORM\Column(type="integer")
     */
    private $etat;


     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Bien" , inversedBy="reservation")
     */
    private $bien;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client" , inversedBy="reservation")
     */
    private $client;

    public function getId()
    {
        return $this->id;
    }

    public function getDatereserv(): ?\DateTimeInterface
    {
        return $this->datereserv;
    }

    public function setDatereserv(\DateTimeInterface $datereserv): self
    {
        $this->datereserv = $datereserv;

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
     * Get the value of client
     */ 
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set the value of client
     *
     * @return  self
     */ 
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get the value of bien
     */ 
    public function getBien()
    {
        return $this->bien;
    }

    /**
     * Set the value of bien
     *
     * @return  self
     */ 
    public function setBien($bien)
    {
        $this->bien = $bien;

        return $this;
    }
}
