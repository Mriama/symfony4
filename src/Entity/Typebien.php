<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypebienRepository")
 */
class Typebien
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
    private $nomtypebien;

    public function getId()
    {
        return $this->id;
    }

    public function getNomtypebien(): ?string
    {
        return $this->nomtypebien;
    }

    public function setNomtypebien(string $nomtypebien): self
    {
        $this->nomtypebien = $nomtypebien;

        return $this;
    }
}
