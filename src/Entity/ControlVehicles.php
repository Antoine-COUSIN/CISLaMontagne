<?php

namespace App\Entity;

use App\Repository\ControlVehiclesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ControlVehiclesRepository::class)
 */
class ControlVehicles
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
    private $oilLevel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $refreshFluidLevel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $washingFluidLevel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $frontWireShape;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $backTireShape;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bodyShape;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $indoorShape;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $frontWiper;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $backWiper;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $frontLighting;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $backLighting;

    /**
     * @ORM\Column(type="text")
     */
    private $annotation;

    /**
     * @ORM\Column(type="date")
     */
    private $dateControl;

    /**
     * @ORM\ManyToOne(targetEntity=Vehicles::class, inversedBy="controlVehicle")
     */
    private $vehicles;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOilLevel(): ?string
    {
        return $this->oilLevel;
    }

    public function setOilLevel(string $oilLevel): self
    {
        $this->oilLevel = $oilLevel;

        return $this;
    }

    public function getRefreshFluidLevel(): ?string
    {
        return $this->refreshFluidLevel;
    }

    public function setRefreshFluidLevel(string $refreshFluidLevel): self
    {
        $this->refreshFluidLevel = $refreshFluidLevel;

        return $this;
    }

    public function getWashingFluidLevel(): ?string
    {
        return $this->washingFluidLevel;
    }

    public function setWashingFluidLevel(string $washingFluidLevel): self
    {
        $this->washingFluidLevel = $washingFluidLevel;

        return $this;
    }

    public function getFrontWireShape(): ?string
    {
        return $this->frontWireShape;
    }

    public function setFrontWireShape(string $frontWireShape): self
    {
        $this->frontWireShape = $frontWireShape;

        return $this;
    }

    public function getBackTireShape(): ?string
    {
        return $this->backTireShape;
    }

    public function setBackTireShape(string $backTireShape): self
    {
        $this->backTireShape = $backTireShape;

        return $this;
    }

    public function getBodyShape(): ?string
    {
        return $this->bodyShape;
    }

    public function setBodyShape(string $bodyShape): self
    {
        $this->bodyShape = $bodyShape;

        return $this;
    }

    public function getIndoorShape(): ?string
    {
        return $this->indoorShape;
    }

    public function setIndoorShape(string $indoorShape): self
    {
        $this->indoorShape = $indoorShape;

        return $this;
    }

    public function getFrontWiper(): ?string
    {
        return $this->frontWiper;
    }

    public function setFrontWiper(string $frontWiper): self
    {
        $this->frontWiper = $frontWiper;

        return $this;
    }

    public function getBackWiper(): ?string
    {
        return $this->backWiper;
    }

    public function setBackWiper(string $backWiper): self
    {
        $this->backWiper = $backWiper;

        return $this;
    }

    public function getFrontLighting(): ?string
    {
        return $this->frontLighting;
    }

    public function setFrontLighting(string $frontLighting): self
    {
        $this->frontLighting = $frontLighting;

        return $this;
    }

    public function getBackLighting(): ?string
    {
        return $this->backLighting;
    }

    public function setBackLighting(string $backLighting): self
    {
        $this->backLighting = $backLighting;

        return $this;
    }

    public function getAnnotation(): ?string
    {
        return $this->annotation;
    }

    public function setAnnotation(string $annotation): self
    {
        $this->annotation = $annotation;

        return $this;
    }

    public function getDateControl(): ?\DateTimeInterface
    {
        return $this->dateControl;
    }

    public function setDateControl(\DateTimeInterface $dateControl): self
    {
        $this->dateControl = $dateControl;

        return $this;
    }

    public function getVehicles(): ?Vehicles
    {
        return $this->vehicles;
    }

    public function setVehicles(?Vehicles $vehicles): self
    {
        $this->vehicles = $vehicles;

        return $this;
    }
}
