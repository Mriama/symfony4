<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContratRepository")
 */
class Contrat
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
    private $datecontrat;

    /**
     * @ORM\Column(type="integer")
     */
    private $caution;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $duree;

      /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Bien" , inversedBy="contrat")
     */
    private $bien;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client" , inversedBy="contrat")
     */
    private $client;

      /**
         * @ORM\OneToMany(targetEntity="App\Entity\Paiement", mappedBy="contrat")
         */
        private $paiement;


    public function getId()
    {
        return $this->id;
    }

    public function getDatecontrat(): ?\DateTimeInterface
    {
        return $this->datecontrat;
    }

    public function setDatecontrat(\DateTimeInterface $datecontrat): self
    {
        $this->datecontrat = $datecontrat;

        return $this;
    }

    public function getCaution(): ?int
    {
        return $this->caution;
    }

    public function setCaution(int $caution): self
    {
        $this->caution = $caution;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): self
    {
        $this->duree = $duree;

        return $this;
    }
}
