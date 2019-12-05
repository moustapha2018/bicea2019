<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BuArticleRepository")
 */
class BuArticle
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
    private $articleName;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $unitPrice;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BiceaAdmin", inversedBy="buArticles")
     */
    private $BiceaAdmin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BuCategory", inversedBy="buArticles")
     */
    private $BuCategory;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comment;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BuCustomerOrder", mappedBy="BuArticle")
     */
    private $buCustomerOrders;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $unit;

    /**
     * @ORM\Column(type="integer")
     */
    private $articleQuantity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    

    public function __construct()
    {
        $this->buCustomerOrders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticleName(): ?string
    {
        return $this->articleName;
    }

    public function setArticleName(string $articleName): self
    {
        $this->articleName = $articleName;

        return $this;
    }

    public function getUnitPrice(): ?float
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(?float $unitPrice): self
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getBiceaAdmin(): ?BiceaAdmin
    {
        return $this->BiceaAdmin;
    }

    public function setBiceaAdmin(?BiceaAdmin $BiceaAdmin): self
    {
        $this->BiceaAdmin = $BiceaAdmin;

        return $this;
    }

    public function getBuCategory(): ?BuCategory
    {
        return $this->BuCategory;
    }

    public function setBuCategory(?BuCategory $BuCategory): self
    {
        $this->BuCategory = $BuCategory;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return Collection|BuCustomerOrder[]
     */
    public function getBuCustomerOrders(): Collection
    {
        return $this->buCustomerOrders;
    }

    public function addBuCustomerOrder(BuCustomerOrder $buCustomerOrder): self
    {
        if (!$this->buCustomerOrders->contains($buCustomerOrder)) {
            $this->buCustomerOrders[] = $buCustomerOrder;
            $buCustomerOrder->setBuArticle($this);
        }

        return $this;
    }

    public function removeBuCustomerOrder(BuCustomerOrder $buCustomerOrder): self
    {
        if ($this->buCustomerOrders->contains($buCustomerOrder)) {
            $this->buCustomerOrders->removeElement($buCustomerOrder);
            // set the owning side to null (unless already changed)
            if ($buCustomerOrder->getBuArticle() === $this) {
                $buCustomerOrder->setBuArticle(null);
            }
        }

        return $this;
    }

    
    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): self
    {
        $this->unit = $unit;

        return $this;
    }

    public function getArticleQuantity(): ?int
    {
        return $this->articleQuantity;
    }

    public function setArticleQuantity(int $articleQuantity): self
    {
        $this->articleQuantity = $articleQuantity;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }


}
