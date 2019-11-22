<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BuCategoryRepository")
 */
class BuCategory
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
    private $categoryName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comment;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BiceaAdmin", inversedBy="buCategories")
     */
    private $BiceaAdmin;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BuArticle", mappedBy="BuCategory")
     */
    private $buArticles;

    public function __construct()
    {
        $this->buArticles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoryName(): ?string
    {
        return $this->categoryName;
    }

    public function setCategoryName(string $categoryName): self
    {
        $this->categoryName = $categoryName;

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

    /**
     * @return Collection|BuArticle[]
     */
    public function getBuArticles(): Collection
    {
        return $this->buArticles;
    }

    public function addBuArticle(BuArticle $buArticle): self
    {
        if (!$this->buArticles->contains($buArticle)) {
            $this->buArticles[] = $buArticle;
            $buArticle->setBuCategory($this);
        }

        return $this;
    }

    public function removeBuArticle(BuArticle $buArticle): self
    {
        if ($this->buArticles->contains($buArticle)) {
            $this->buArticles->removeElement($buArticle);
            // set the owning side to null (unless already changed)
            if ($buArticle->getBuCategory() === $this) {
                $buArticle->setBuCategory(null);
            }
        }

        return $this;
    }
}
