<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RhFunctionRepository")
 */
class RhFunction
{
    const description = 'description';
    const comment = 'comment';
    const createdAt = 'createdAt';
    const createdByAdmin = 'createdByAdmin';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $functionName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $comment;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;



    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RhUser", mappedBy="RhFunction")
     */
    private $rhUsers;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BiceaAdmin", inversedBy="rhFunctions")
     */
    private $BiceaAdmin;



    public function __construct()
    {
        $this->rhUsers = new ArrayCollection();
    }





    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFunctionName(): ?string
    {
        return $this->functionName;
    }

    public function setFunctionName(string $functionName): self
    {
        $this->functionName = $functionName;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
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



    /**
     * @return Collection|RhUser[]
     */
    public function getRhUsers(): Collection
    {
        return $this->rhUsers;
    }

    public function addRhUser(RhUser $rhUser): self
    {
        if (!$this->rhUsers->contains($rhUser)) {
            $this->rhUsers[] = $rhUser;
            $rhUser->setRhFunction($this);
        }

        return $this;
    }

    public function removeRhUser(RhUser $rhUser): self
    {
        if ($this->rhUsers->contains($rhUser)) {
            $this->rhUsers->removeElement($rhUser);
            // set the owning side to null (unless already changed)
            if ($rhUser->getRhFunction() === $this) {
                $rhUser->setRhFunction(null);
            }
        }

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






}
