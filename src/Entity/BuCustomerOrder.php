<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BuCustomerOrderRepository")
 */
class BuCustomerOrder
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
    private $numberOrder;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BuCustomer", inversedBy="buCustomerOrders")
     */
    private $BuCustomer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BuArticle", inversedBy="buCustomerOrders")
     */
    private $BuArticle;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BiceaAdmin", inversedBy="buCustomerOrders")
     */
    private $BiceaAdmin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberOrder(): ?string
    {
        return $this->numberOrder;
    }

    public function setNumberOrder(string $numberOrder): self
    {
        $this->numberOrder = $numberOrder;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

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

    public function getBuCustomer(): ?BuCustomer
    {
        return $this->BuCustomer;
    }

    public function setBuCustomer(?BuCustomer $BuCustomer): self
    {
        $this->BuCustomer = $BuCustomer;

        return $this;
    }

    public function getBuArticle(): ?BuArticle
    {
        return $this->BuArticle;
    }

    public function setBuArticle(?BuArticle $BuArticle): self
    {
        $this->BuArticle = $BuArticle;

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
