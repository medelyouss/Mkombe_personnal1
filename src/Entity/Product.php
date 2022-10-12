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
    use ProductConditionTrait;

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
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $shortdescription;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $strongpoints;

    /**
     * @ORM\ManyToMany(targetEntity=Productcolor::class, inversedBy="products")
     */
    private $colors;

    /**
     * @Assert\All({
     *  @Assert\Image(mimeTypes={"image/png", "image/jpeg", "image/jpg"})
     * })
     */
    private $fichiersImage;


    //======= Mchadhariet autres ======//
    /**
     * Provenance (D'où provient le produit)
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $origin;

    /**=================== Disponibilité ============= 1) dispo en stock, dispo sur commande, indispo
     *
     * @ORM\Column(type="string", length=150)
     */
    private $availablity;


    //============ DRAP ================
    /**
     * @ORM\ManyToMany(targetEntity=Drapdimension::class, inversedBy="products")
     */
    private $drapdimension;

    //============ FIN DRAP ================
    /**
     * @ORM\ManyToOne(targetEntity=Productmarque::class, inversedBy="products")
     */
    private $marque;

    /**
     * @ORM\ManyToMany(targetEntity=Productcategory::class, inversedBy="products")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity=Productimage::class, mappedBy="product", orphanRemoval=true, cascade={"persist"})
     */
    private $images;
    
    public function __construct()
    {
        date_default_timezone_set("Africa/Dar_es_Salaam");
        $this->colors = new ArrayCollection();
        $this->drapdimension = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->images = new ArrayCollection();
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getShortdescription(): ?string
    {
        return $this->shortdescription;
    }

    public function setShortdescription(string $shortdescription): self
    {
        $this->shortdescription = $shortdescription;

        return $this;
    }

    public function getStrongpoints(): ?string
    {
        return $this->strongpoints;
    }

    public function setStrongpoints(?string $strongpoints): self
    {
        $this->strongpoints = $strongpoints;

        return $this;
    }

    /**
     * @return Collection<int, Productcolor>
     */
    public function getColors(): Collection
    {
        return $this->colors;
    }

    public function addColor(Productcolor $color): self
    {
        if (!$this->colors->contains($color)) {
            $this->colors[] = $color;
        }

        return $this;
    }

    public function removeColor(Productcolor $color): self
    {
        $this->colors->removeElement($color);

        return $this;
    }

    //================ IMAGES ===========

    /**
     * @return mixed
     */
    public function getFichiersImage()
    {
        return $this->fichiersImage;
    }

    /**
     * @param $fichiersImage
     * @return Product
     */

    public function setFichiersImage($fichiersImage): self
    {
        foreach ($fichiersImage as $fichierImage){
            $image = new Productimage();
            $image->setImageFile($fichierImage);
            $this->addImage($image);
        }
        $this->fichiersImage = $fichiersImage;
        return $this;
    }

    //================ FIN IMAGES ===========


    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function setOrigin(?string $origin): self
    {
        $this->origin = $origin;

        return $this;
    }

    public function getAvailablity(): ?string
    {
        return $this->availablity;
    }

    public function setAvailablity(string $availablity): self
    {
        $this->availablity = $availablity;

        return $this;
    }

    /**
     * @return Collection<int, Drapdimension>
     */
    public function getDrapdimension(): Collection
    {
        return $this->drapdimension;
    }

    public function addDrapdimension(Drapdimension $drapdimension): self
    {
        if (!$this->drapdimension->contains($drapdimension)) {
            $this->drapdimension[] = $drapdimension;
        }

        return $this;
    }

    public function removeDrapdimension(Drapdimension $drapdimension): self
    {
        $this->drapdimension->removeElement($drapdimension);

        return $this;
    }

    public function getMarque(): ?Productmarque
    {
        return $this->marque;
    }

    public function setMarque(?Productmarque $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * @return Collection<int, Productcategory>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Productcategory $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Productcategory $category): self
    {
        $this->categories->removeElement($category);

        return $this;
    }

    /**
     * @return Collection<int, Productimage>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Productimage $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setProduct($this);
        }

        return $this;
    }

    public function removeImage(Productimage $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getProduct() === $this) {
                $image->setProduct(null);
            }
        }

        return $this;
    }
}
