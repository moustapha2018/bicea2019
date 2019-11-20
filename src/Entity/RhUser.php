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

    /**
     * @ORM\Column(type="boolean")
     */
    private $isCustomerSupplierShareHolser;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isMovement;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isStockTransport;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAdministratorManagement;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isHumanRessource;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isOperation;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RhContract", mappedBy="RhUser")
     */
    private $rhContracts;




    public function __construct()
    {
        $this->rhFunctions = new ArrayCollection();
        $this->rhfunctions = new ArrayCollection();
        $this->rhFileUsers = new ArrayCollection();
        //$this->projects = new ArrayCollection();
        $this->prTasks = new ArrayCollection();
        $this->rhContracts = new ArrayCollection();
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

    public function getIsCustomerSupplierShareHolser(): ?bool
    {
        return $this->isCustomerSupplierShareHolser;
    }

    public function setIsCustomerSupplierShareHolser(bool $isCustomerSupplierShareHolser): self
    {
        $this->isCustomerSupplierShareHolser = $isCustomerSupplierShareHolser;

        return $this;
    }

    public function getIsMovement(): ?bool
    {
        return $this->isMovement;
    }

    public function setIsMovement(bool $isMovement): self
    {
        $this->isMovement = $isMovement;

        return $this;
    }

    public function getIsStockTransport(): ?bool
    {
        return $this->isStockTransport;
    }

    public function setIsStockTransport(bool $isStockTransport): self
    {
        $this->isStockTransport = $isStockTransport;

        return $this;
    }

    public function getIsAdministratorManagement(): ?bool
    {
        return $this->isAdministratorManagement;
    }

    public function setIsAdministratorManagement(bool $isAdministratorManagement): self
    {
        $this->isAdministratorManagement = $isAdministratorManagement;

        return $this;
    }

    public function getIsHumanRessource(): ?bool
    {
        return $this->isHumanRessource;
    }

    public function setIsHumanRessource(bool $isHumanRessource): self
    {
        $this->isHumanRessource = $isHumanRessource;

        return $this;
    }

    public function getIsOperation(): ?bool
    {
        return $this->isOperation;
    }

    public function setIsOperation(bool $isOperation): self
    {
        $this->isOperation = $isOperation;

        return $this;
    }

    /**
     * @return Collection|RhContract[]
     */
    public function getRhContracts(): Collection
    {
        return $this->rhContracts;
    }

    public function addRhContract(RhContract $rhContract): self
    {
        if (!$this->rhContracts->contains($rhContract)) {
            $this->rhContracts[] = $rhContract;
            $rhContract->setRhUser($this);
        }

        return $this;
    }

    public function removeRhContract(RhContract $rhContract): self
    {
        if ($this->rhContracts->contains($rhContract)) {
            $this->rhContracts->removeElement($rhContract);
            // set the owning side to null (unless already changed)
            if ($rhContract->getRhUser() === $this) {
                $rhContract->setRhUser(null);
            }
        }

        return $this;
    }









}
