<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomerRepository")
 */
class Customer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $dni;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $postal_code;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comanda", mappedBy="customer")
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

    public function getDni(): ?string
    {
        return $this->dni;
    }

    public function setDni(string $dni): self
    {
        $this->dni = $dni;

        return $this;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(?int $telephone): self
    {
        $this->telephone = $telephone;

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

    public function getDnia(): ?int
    {
        return $this->dnia;
    }

    public function setDnia(int $dnia): self
    {
        $this->dnia = $dnia;

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
            $comanda->setCustomer($this);
        }

        return $this;
    }

    public function removeComanda(Comanda $comanda): self
    {
        if ($this->comandas->contains($comanda)) {
            $this->comandas->removeElement($comanda);
            // set the owning side to null (unless already changed)
            if ($comanda->getCustomer() === $this) {
                $comanda->setCustomer(null);
            }
        }

        return $this;
    }
    public function __toString() {
        return $this->name;
    }
}
