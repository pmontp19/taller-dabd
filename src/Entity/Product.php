<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
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
    private $brand;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $model;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $year;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $serial;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comanda", mappedBy="product")
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

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getYear(): ?\DateTimeInterface
    {
        return $this->year;
    }

    public function setYear(?\DateTimeInterface $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getSerial(): ?int
    {
        return $this->serial;
    }

    public function setSerial(?int $serial): self
    {
        $this->serial = $serial;

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
            $comanda->setProduct($this);
        }

        return $this;
    }

    public function removeComanda(Comanda $comanda): self
    {
        if ($this->comandas->contains($comanda)) {
            $this->comandas->removeElement($comanda);
            // set the owning side to null (unless already changed)
            if ($comanda->getProduct() === $this) {
                $comanda->setProduct(null);
            }
        }

        return $this;
    }
    public function __toString() {
        return $this->brand.' '.$this->model;
    }
}
