<?php

namespace App\Entity;

use App\Repository\OrderStatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderStatusRepository::class)
 */
class OrderStatus
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statusName;

    /**
     * @ORM\OneToMany(targetEntity=OrderRequired::class, mappedBy="orderStatus")
     */
    private $orderRequired;

    public function __construct()
    {
        $this->orderRequired = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatusName(): ?string
    {
        return $this->statusName;
    }

    public function setStatusName(string $statusName): self
    {
        $this->statusName = $statusName;

        return $this;
    }

    /**
     * @return Collection|OrderRequired[]
     */
    public function getOrderRequired(): Collection
    {
        return $this->orderRequired;
    }

    public function addOrderRequired(OrderRequired $orderRequired): self
    {
        if (!$this->orderRequired->contains($orderRequired)) {
            $this->orderRequired[] = $orderRequired;
            $orderRequired->setOrderStatus($this);
        }

        return $this;
    }

    public function removeOrderRequired(OrderRequired $orderRequired): self
    {
        if ($this->orderRequired->removeElement($orderRequired)) {
            // set the owning side to null (unless already changed)
            if ($orderRequired->getOrderStatus() === $this) {
                $orderRequired->setOrderStatus(null);
            }
        }

        return $this;
    }
}
