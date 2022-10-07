<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    //use GenreTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $designation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreatedAt;


    /**
     * @ORM\Column(type="string", length=255,  nullable=true)
     */
    private $miniDescription;

    /**
     * @ORM\Column(type="float")
     */
    private $price;


     //* ======================== FIELDS SPECIFIQUE A VETEMENT ================================
    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $vetementTaille;

    /**
     * @ORM\ManyToMany(targetEntity=ProductColor::class, inversedBy="products")
     */
    private $colors;

    /**
     * @ORM\ManyToMany(targetEntity=Concerne::class, inversedBy="products")
     */
    private $concernes;

    //========================- FIN FIELDS SPECIFIQUE A VETEMENT -================================
    
    public function __construct()
    {
        date_default_timezone_set("Africa/Dar_es_Salaam");
        $this->colors = new ArrayCollection();
        $this->concernes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getDateCreatedAt(): ?\DateTimeInterface
    {
        return $this->dateCreatedAt;
    }

    public function setDateCreatedAt(\DateTimeInterface $dateCreatedAt): self
    {
        $this->dateCreatedAt = $dateCreatedAt;

        return $this;
    }

    public function getMiniDescription(): ?string
    {
        return $this->miniDescription;
    }

    public function setMiniDescription(string $miniDescription): self
    {
        $this->miniDescription = $miniDescription;

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

    public function getVetementTaille(): ?float
    {
        return $this->vetementTaille;
    }

    public function setVetementTaille(?float $vetementTaille): self
    {
        $this->vetementTaille = $vetementTaille;

        return $this;
    }

    /**
     * @return Collection<int, ProductColor>
     */
    public function getColors(): Collection
    {
        return $this->colors;
    }

    public function addColor(ProductColor $color): self
    {
        if (!$this->colors->contains($color)) {
            $this->colors[] = $color;
        }

        return $this;
    }

    public function removeColor(ProductColor $color): self
    {
        $this->colors->removeElement($color);

        return $this;
    }

    /**
     * @return Collection<int, Concerne>
     */
    public function getConcernes(): Collection
    {
        return $this->concernes;
    }

    public function addConcerne(Concerne $concerne): self
    {
        if (!$this->concernes->contains($concerne)) {
            $this->concernes[] = $concerne;
        }

        return $this;
    }

    public function removeConcerne(Concerne $concerne): self
    {
        $this->concernes->removeElement($concerne);

        return $this;
    }
}
