<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ComandaRepository")
 */
class Comanda
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creation;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $comments;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="comandas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="comandas")
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Workshop", inversedBy="comandas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $workshop;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Part", inversedBy="comandas")
     */
    private $part;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Service", inversedBy="comandas")
     */
    private $service;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Technician", inversedBy="comandas")
     */
    private $technician;

    public function __construct()
    {
        $this->part = new ArrayCollection();
        $this->service = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreation(): ?\DateTimeInterface
    {
        return $this->creation;
    }

    public function setCreation(\DateTimeInterface $creation): self
    {
        $this->creation = $creation;

        return $this;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(?string $comments): self
    {
        $this->comments = $comments;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getWorkshop(): ?Workshop
    {
        return $this->workshop;
    }

    public function setWorkshop(?Workshop $workshop): self
    {
        $this->workshop = $workshop;

        return $this;
    }

    /**
     * @return Collection|Part[]
     */
    public function getPart(): Collection
    {
        return $this->part;
    }

    public function addPart(Part $part): self
    {
        if (!$this->part->contains($part)) {
            $this->part[] = $part;
        }

        return $this;
    }

    public function removePart(Part $part): self
    {
        if ($this->part->contains($part)) {
            $this->part->removeElement($part);
        }

        return $this;
    }

    /**
     * @return Collection|Service[]
     */
    public function getService(): Collection
    {
        return $this->service;
    }

    public function addService(Service $service): self
    {
        if (!$this->service->contains($service)) {
            $this->service[] = $service;
        }

        return $this;
    }

    public function removeService(Service $service): self
    {
        if ($this->service->contains($service)) {
            $this->service->removeElement($service);
        }

        return $this;
    }

    public function getTechnician(): ?Technician
    {
        return $this->technician;
    }

    public function setTechnician(?Technician $technician): self
    {
        $this->technician = $technician;

        return $this;
    }
}
