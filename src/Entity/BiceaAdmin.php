<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BiceaAdminRepository")
 */
class BiceaAdmin
{
    const firstName = 'firstName';
    const lastName = 'lastName';
    const email = 'email';
    const password = 'password';
    const phone = 'phone';
    const createdAt = 'createdAt';
    const loginAdmin = 'loginAdmin';
    const companyName = 'companyName';
    const headOffice  = 'headOffice';
    const siret   = 'siret';
    const loginCompany   = 'loginCompany ';
    const active   = 'active';
    const paid   = 'paid';
    const activitySector   = 'activitySector';

    #type of activity sector
    const education = 'Education';
    const business = 'Business';
    const bicea = 'Bicea';

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
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $loginAdmin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $companyName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $headOffice;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $loginCompany;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\Column(type="boolean")
     */
    private $paid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $activitySector;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RhUser", mappedBy="BiceaAdmin")
     */
    private $rhUsers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RhFunction", mappedBy="BiceaAdmin")
     */
    private $rhFunctions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Project", mappedBy="BiceaAdmin")
     */
    private $projects;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PrTask", mappedBy="BiceaAdmin")
     */
    private $prTasks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RhContract", mappedBy="BiceaAdmin")
     */
    private $rhContracts;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BuCustomer", mappedBy="BiceaAdmin")
     */
    private $buCustomers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BuSupplier", mappedBy="BiceaAdmin")
     */
    private $buSuppliers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BuCategory", mappedBy="BiceaAdmin")
     */
    private $buCategories;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BuArticle", mappedBy="BiceaAdmin")
     */
    private $buArticles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BuCustomerOrder", mappedBy="BiceaAdmin")
     */
    private $buCustomerOrders;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionCompany;


    public function __construct()
    {
        $this->rhFunctions = new ArrayCollection();
        $this->rhUsers = new ArrayCollection();
        $this->projects = new ArrayCollection();
        $this->prTasks = new ArrayCollection();
        $this->rhContracts = new ArrayCollection();
        $this->buCustomers = new ArrayCollection();
        $this->buSuppliers = new ArrayCollection();
        $this->buCategories = new ArrayCollection();
        $this->buArticles = new ArrayCollection();
        $this->buCustomerOrders = new ArrayCollection();
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getLoginAdmin(): ?string
    {
        return $this->loginAdmin;
    }

    public function setLoginAdmin(string $loginAdmin): self
    {
        $this->loginAdmin = $loginAdmin;

        return $this;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getHeadOffice(): ?string
    {
        return $this->headOffice;
    }

    public function setHeadOffice(string $headOffice): self
    {
        $this->headOffice = $headOffice;

        return $this;
    }

    public function getLoginCompany(): ?string
    {
        return $this->loginCompany;
    }

    public function setLoginCompany(string $loginCompany): self
    {
        $this->loginCompany = $loginCompany;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getPaid(): ?bool
    {
        return $this->paid;
    }

    public function setPaid(bool $paid): self
    {
        $this->paid = $paid;

        return $this;
    }

    public function getActivitySector(): ?string
    {
        return $this->activitySector;
    }

    public function setActivitySector(string $activitySector): self
    {
        $this->activitySector = $activitySector;

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
            $rhUser->setBiceaAdmin($this);
        }

        return $this;
    }

    public function removeRhUser(RhUser $rhUser): self
    {
        if ($this->rhUsers->contains($rhUser)) {
            $this->rhUsers->removeElement($rhUser);
            // set the owning side to null (unless already changed)
            if ($rhUser->getBiceaAdmin() === $this) {
                $rhUser->setBiceaAdmin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RhFunction[]
     */
    public function getRhFunctions(): Collection
    {
        return $this->rhFunctions;
    }

    public function addRhFunction(RhFunction $rhFunction): self
    {
        if (!$this->rhFunctions->contains($rhFunction)) {
            $this->rhFunctions[] = $rhFunction;
            $rhFunction->setBiceaAdmin($this);
        }

        return $this;
    }

    public function removeRhFunction(RhFunction $rhFunction): self
    {
        if ($this->rhFunctions->contains($rhFunction)) {
            $this->rhFunctions->removeElement($rhFunction);
            // set the owning side to null (unless already changed)
            if ($rhFunction->getBiceaAdmin() === $this) {
                $rhFunction->setBiceaAdmin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Project[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->setBiceaAdmin($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
            // set the owning side to null (unless already changed)
            if ($project->getBiceaAdmin() === $this) {
                $project->setBiceaAdmin(null);
            }
        }

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
            $prTask->setBiceaAdmin($this);
        }

        return $this;
    }

    public function removePrTask(PrTask $prTask): self
    {
        if ($this->prTasks->contains($prTask)) {
            $this->prTasks->removeElement($prTask);
            // set the owning side to null (unless already changed)
            if ($prTask->getBiceaAdmin() === $this) {
                $prTask->setBiceaAdmin(null);
            }
        }

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
            $rhContract->setBiceaAdmin($this);
        }

        return $this;
    }

    public function removeRhContract(RhContract $rhContract): self
    {
        if ($this->rhContracts->contains($rhContract)) {
            $this->rhContracts->removeElement($rhContract);
            // set the owning side to null (unless already changed)
            if ($rhContract->getBiceaAdmin() === $this) {
                $rhContract->setBiceaAdmin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|BuCustomer[]
     */
    public function getBuCustomers(): Collection
    {
        return $this->buCustomers;
    }

    public function addBuCustomer(BuCustomer $buCustomer): self
    {
        if (!$this->buCustomers->contains($buCustomer)) {
            $this->buCustomers[] = $buCustomer;
            $buCustomer->setBiceaAdmin($this);
        }

        return $this;
    }

    public function removeBuCustomer(BuCustomer $buCustomer): self
    {
        if ($this->buCustomers->contains($buCustomer)) {
            $this->buCustomers->removeElement($buCustomer);
            // set the owning side to null (unless already changed)
            if ($buCustomer->getBiceaAdmin() === $this) {
                $buCustomer->setBiceaAdmin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|BuSupplier[]
     */
    public function getBuSuppliers(): Collection
    {
        return $this->buSuppliers;
    }

    public function addBuSupplier(BuSupplier $buSupplier): self
    {
        if (!$this->buSuppliers->contains($buSupplier)) {
            $this->buSuppliers[] = $buSupplier;
            $buSupplier->setBiceaAdmin($this);
        }

        return $this;
    }

    public function removeBuSupplier(BuSupplier $buSupplier): self
    {
        if ($this->buSuppliers->contains($buSupplier)) {
            $this->buSuppliers->removeElement($buSupplier);
            // set the owning side to null (unless already changed)
            if ($buSupplier->getBiceaAdmin() === $this) {
                $buSupplier->setBiceaAdmin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|BuCategory[]
     */
    public function getBuCategories(): Collection
    {
        return $this->buCategories;
    }

    public function addBuCategory(BuCategory $buCategory): self
    {
        if (!$this->buCategories->contains($buCategory)) {
            $this->buCategories[] = $buCategory;
            $buCategory->setBiceaAdmin($this);
        }

        return $this;
    }

    public function removeBuCategory(BuCategory $buCategory): self
    {
        if ($this->buCategories->contains($buCategory)) {
            $this->buCategories->removeElement($buCategory);
            // set the owning side to null (unless already changed)
            if ($buCategory->getBiceaAdmin() === $this) {
                $buCategory->setBiceaAdmin(null);
            }
        }

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
            $buArticle->setBiceaAdmin($this);
        }

        return $this;
    }

    public function removeBuArticle(BuArticle $buArticle): self
    {
        if ($this->buArticles->contains($buArticle)) {
            $this->buArticles->removeElement($buArticle);
            // set the owning side to null (unless already changed)
            if ($buArticle->getBiceaAdmin() === $this) {
                $buArticle->setBiceaAdmin(null);
            }
        }

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
            $buCustomerOrder->setBiceaAdmin($this);
        }

        return $this;
    }

    public function removeBuCustomerOrder(BuCustomerOrder $buCustomerOrder): self
    {
        if ($this->buCustomerOrders->contains($buCustomerOrder)) {
            $this->buCustomerOrders->removeElement($buCustomerOrder);
            // set the owning side to null (unless already changed)
            if ($buCustomerOrder->getBiceaAdmin() === $this) {
                $buCustomerOrder->setBiceaAdmin(null);
            }
        }

        return $this;
    }

    public function getDescriptionCompany(): ?string
    {
        return $this->descriptionCompany;
    }

    public function setDescriptionCompany(?string $descriptionCompany): self
    {
        $this->descriptionCompany = $descriptionCompany;

        return $this;
    }

    }
