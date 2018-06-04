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
     * @ORM\Column(type="string", length=25)
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



    /**
     * Get the value of telclient
     */
    public function getTelclient()
    {
        return $this->telclient;
    }

    /**
     * Set the value of telclient
     *
     * @return  self
     */
    public function setTelclient($telclient)
    {
        $this->telclient = $telclient;

        return $this;
    }

    /**
     * Get the value of adressclient
     */
    public function getAdressclient()
    {
        return $this->adressclient;
    }

    /**
     * Set the value of adressclient
     *
     * @return  self
     */
    public function setAdressclient($adressclient)
    {
        $this->adressclient = $adressclient;

        return $this;
    }

    /**
     * Get the value of numeropiece
     */
    public function getNumeropiece()
    {
        return $this->numeropiece;
    }

    /**
     * Set the value of numeropiece
     *
     * @return  self
     */
    public function setNumeropiece($numeropiece)
    {
        $this->numeropiece = $numeropiece;

        return $this;
    }

    /**
     * Get the value of nomclient
     */
    public function getNomclient()
    {
        return $this->nomclient;
    }

    /**
     * Set the value of nomclient
     *
     * @return  self
     */
    public function setNomclient($nomclient)
    {
        $this->nomclient = $nomclient;

        return $this;
    }

    /**
     * Get the value of mailclient
     */
    public function getMailclient()
    {
        return $this->mailclient;
    }

    /**
     * Set the value of mailclient
     *
     * @return  self
     */
    public function setMailclient($mailclient)
    {
        $this->mailclient = $mailclient;

        return $this;
    }

        /**
         * Get the value of reservation
         */
        public function getReservation()
        {
                return $this->reservation;
        }

        /**
         * Set the value of reservation
         *
         * @return  self
         */
        public function setReservation($reservation)
        {
                $this->reservation = $reservation;

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

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
