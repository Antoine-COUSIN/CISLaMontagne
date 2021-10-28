<?php

namespace App\Entity;

use App\Repository\PharmaStockRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PharmaStockRepository::class)
 */
class PharmaStock
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
    private $productsName;

    /**
     * @ORM\Column(type="integer")
     */
    private $productsQuantity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductsName(): ?string
    {
        return $this->productsName;
    }

    public function setProductsName(string $productsName): self
    {
        $this->productsName = $productsName;

        return $this;
    }

    public function getProductsQuantity(): ?int
    {
        return $this->productsQuantity;
    }

    public function setProductsQuantity(int $productsQuantity): self
    {
        $this->productsQuantity = $productsQuantity;

        return $this;
    }
}
