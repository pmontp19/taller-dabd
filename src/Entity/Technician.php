<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TechnicianRepository")
 */
class Technician
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthdate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $postal_code;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Workshop", inversedBy="technicians")
     */
    private $workplace;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comanda", mappedBy="technician")
     */
    private $comandas;

    public function __construct()
    {
        $this->comandas = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postal_code;
    }

    public function setPostalCode(?int $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getWorkplace(): ?Workshop
    {
        return $this->workplace;
    }

    public function setWorkplace(?Workshop $workplace): self
    {
        $this->workplace = $workplace;

        return $this;
    }

    /**
     * @return Collection|Comanda[]
     */
    public function getComandas(): Collection
    {
        return $this->comandas;
    }

    public function addComanda(Comanda $comanda): self
    {
        if (!$this->comandas->contains($comanda)) {
            $this->comandas[] = $comanda;
            $comanda->setTechnician($this);
        }

        return $this;
    }

    public function removeComanda(Comanda $comanda): self
    {
        if ($this->comandas->contains($comanda)) {
            $this->comandas->removeElement($comanda);
            // set the owning side to null (unless already changed)
            if ($comanda->getTechnician() === $this) {
                $comanda->setTechnician(null);
            }
        }

        return $this;
    }
    public function __toString() {
        return $this->name;
    }
}
