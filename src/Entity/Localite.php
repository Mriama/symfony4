<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocaliteRepository")
 */
class Localite
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
    private $nomlocalite;

    public function getId()
    {
        return $this->id;
    }

    public function getNomlocalite(): ?string
    {
        return $this->nomlocalite;
    }

    public function setNomlocalite(string $nomlocalite): self
    {
        $this->nomlocalite = $nomlocalite;

        return $this;
    }
}
