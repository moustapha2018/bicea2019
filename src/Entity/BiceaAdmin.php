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


    public function __construct()
    {
        $this->rhFunctions = new ArrayCollection();
        $this->rhUsers = new ArrayCollection();
        $this->projects = new ArrayCollection();
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

    }
