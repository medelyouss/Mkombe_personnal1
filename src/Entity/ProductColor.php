<?php

namespace App\Entity;

use App\Repository\ProductcolorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductcolorRepository::class)
 */
class Productcolor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $designation;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class, mappedBy="colors")
     */
    private $products;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $codeColor;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function __toString()
    {
        return (string) $this->getDesignation();
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

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->addColor($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            $product->removeColor($this);
        }

        return $this;
    }

    public function getCodeColor(): ?string
    {
        return $this->codeColor;
    }

    public function setCodeColor(string $codeColor): self
    {
        $this->codeColor = $codeColor;

        return $this;
    }
}
