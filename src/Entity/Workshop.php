<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WorkshopRepository")
 */
class Workshop
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
    private $city;

    /**
     * @ORM\Column(type="integer")
     */
    private $postal_code;

    /**
     * @ORM\Column(type="integer")
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Technician", mappedBy="workplace")
     */
    private $technicians;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comanda", mappedBy="workshop")
     */
    private $comandas;

    public function __construct()
    {
        $this->technicians = new ArrayCollection();
        $this->comandas = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postal_code;
    }

    public function setPostalCode(int $postal_code): self
    {
        $this->postal_code = $postal_code;

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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection|Technician[]
     */
    public function getTechnicians(): Collection
    {
        return $this->technicians;
    }

    public function addTechnician(Technician $technician): self
    {
        if (!$this->technicians->contains($technician)) {
            $this->technicians[] = $technician;
            $technician->setWorkplace($this);
        }

        return $this;
    }

    public function removeTechnician(Technician $technician): self
    {
        if ($this->technicians->contains($technician)) {
            $this->technicians->removeElement($technician);
            // set the owning side to null (unless already changed)
            if ($technician->getWorkplace() === $this) {
                $technician->setWorkplace(null);
            }
        }

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
            $comanda->setWorkshop($this);
        }

        return $this;
    }

    public function removeComanda(Comanda $comanda): self
    {
        if ($this->comandas->contains($comanda)) {
            $this->comandas->removeElement($comanda);
            // set the owning side to null (unless already changed)
            if ($comanda->getWorkshop() === $this) {
                $comanda->setWorkshop(null);
            }
        }

        return $this;
    }
    public function __toString() {
        return $this->city;
    }
}
