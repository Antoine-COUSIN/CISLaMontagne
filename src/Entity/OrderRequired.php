<?php

namespace App\Entity;

use App\Repository\OrderRequiredRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRequiredRepository::class)
 */
class OrderRequired
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $orderDescript;

    /**
     * @ORM\Column(type="date")
     */
    private $orderDate;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="orderRequireds")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=OrderStatus::class, inversedBy="orderRequired")
     */
    private $orderStatus;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderDescript(): ?string
    {
        return $this->orderDescript;
    }

    public function setOrderDescript(string $orderDescript): self
    {
        $this->orderDescript = $orderDescript;

        return $this;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->orderDate;
    }

    public function setOrderDate(\DateTimeInterface $orderDate): self
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getOrderStatus(): ?OrderStatus
    {
        return $this->orderStatus;
    }

    public function setOrderStatus(?OrderStatus $orderStatus): self
    {
        $this->orderStatus = $orderStatus;

        return $this;
    }
}
