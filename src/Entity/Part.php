<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartRepository")
 */
class Part
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
    private $code;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $stock;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Comanda", mappedBy="part")
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

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

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

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

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
            $comanda->addPart($this);
        }

        return $this;
    }

    public function removeComanda(Comanda $comanda): self
    {
        if ($this->comandas->contains($comanda)) {
            $this->comandas->removeElement($comanda);
            $comanda->removePart($this);
        }

        return $this;
    }
    public function __toString() {
        return $this->name.' '.$this->price.' €';
    }
}
