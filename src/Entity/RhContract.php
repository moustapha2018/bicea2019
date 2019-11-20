<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RhContractRepository")
 */
class RhContract
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startDate;


    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $salary;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BiceaAdmin", inversedBy="rhContracts")
     */
    private $BiceaAdmin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\RhUser", inversedBy="rhContracts")
     */
    private $RhUser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

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

    public function getSalary(): ?float
    {
        return $this->salary;
    }

    public function setSalary(?float $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

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

    public function getRhUser(): ?RhUser
    {
        return $this->RhUser;
    }

    public function setRhUser(?RhUser $RhUser): self
    {
        $this->RhUser = $RhUser;

        return $this;
    }
}
