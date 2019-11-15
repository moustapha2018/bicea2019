<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RhUserRepository")
 */
class RhUser
{
    const firstName = 'firstName';
    const lastName = 'lastName';
    const email = 'email';
    const password = 'password';
    const phone = 'phone';
    const createdAt = 'createdAt';
    const loginUser = 'loginUser';
    const contract = 'contract';
    const passport = 'passport';
    const photo = 'photo';
    const createdByAdmin = 'BiceaAdmin';

    const isProjectManager = 'isProjectManager';
    const isAccountant = 'isAccountant';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $loginUser;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contract;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $passport;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\RhFunction", inversedBy="rhUsers")
     */
    private $RhFunction;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BiceaAdmin", inversedBy="rhUsers")
     */
    private $BiceaAdmin;


    /**
     * @ORM\Column(type="boolean")
     */
    private $isProjectManager;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAccountant;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PrTask", mappedBy="RhUser")
     */
    private $prTasks;



    public function __construct()
    {
        $this->rhFunctions = new ArrayCollection();
        $this->rhfunctions = new ArrayCollection();
        $this->rhFileUsers = new ArrayCollection();
        //$this->projects = new ArrayCollection();
        $this->prTasks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

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

    public function getLoginUser(): ?string
    {
        return $this->loginUser;
    }

    public function setLoginUser(string $loginUser): self
    {
        $this->loginUser = $loginUser;

        return $this;
    }

    public function getContract()
    {
        return $this->contract;
    }

    public function setContract( $contract)
    {
        $this->contract = $contract;

        return $this;
    }

    public function getPassport()
    {
        return $this->passport;
    }

    public function setPassport( $passport)
    {
        $this->passport = $passport;

        return $this;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto( $photo)
    {
        $this->photo = $photo;

        return $this;
    }


    public function getRhFunction(): ?RhFunction
    {
        return $this->RhFunction;
    }

    public function setRhFunction(?RhFunction $RhFunction): self
    {
        $this->RhFunction = $RhFunction;

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

    public function getIsProjectManager(): ?bool
    {
        return $this->isProjectManager;
    }

    public function setIsProjectManager(bool $isProjectManager): self
    {
        $this->isProjectManager = $isProjectManager;
        return $this;
    }

    public function getIsAccountant(): ?bool
    {
        return $this->isAccountant;
    }

    public function setIsAccountant(bool $isAccountant): self
    {
        $this->isAccountant = $isAccountant;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return Collection|PrTask[]
     */
    public function getPrTasks(): Collection
    {
        return $this->prTasks;
    }

    public function addPrTask(PrTask $prTask): self
    {
        if (!$this->prTasks->contains($prTask)) {
            $this->prTasks[] = $prTask;
            $prTask->setRhUser($this);
        }

        return $this;
    }

    public function removePrTask(PrTask $prTask): self
    {
        if ($this->prTasks->contains($prTask)) {
            $this->prTasks->removeElement($prTask);
            // set the owning side to null (unless already changed)
            if ($prTask->getRhUser() === $this) {
                $prTask->setRhUser(null);
            }
        }

        return $this;
    }








}
