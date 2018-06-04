<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PaiementRepository")
 */
class Paiement
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
    private $datepaiement;

    /**
     * @ORM\Column(type="integer")
     */
    private $montant;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $periode;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Contrat" , inversedBy="paiement")
     */
    private $contrat;


    public function getId()
    {
        return $this->id;
    }

    public function getDatepaiement(): ?string
    {
        return $this->datepaiement;
    }

    public function setDatepaiement(string $datepaiement): self
    {
        $this->datepaiement = $datepaiement;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getPeriode(): ?string
    {
        return $this->periode;
    }

    public function setPeriode(string $periode): self
    {
        $this->periode = $periode;

        return $this;
    }

    /**
     * Get the value of contrat
     */ 
    public function getContrat()
    {
        return $this->contrat;
    }

    /**
     * Set the value of contrat
     *
     * @return  self
     */ 
    public function setContrat($contrat)
    {
        $this->contrat = $contrat;

        return $this;
    }
}
