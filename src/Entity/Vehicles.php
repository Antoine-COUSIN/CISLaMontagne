<?php

namespace App\Entity;

use App\Repository\VehiclesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VehiclesRepository::class)
 */
class Vehicles
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nameVehicle;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $vehicleMatricule;

    /**
     * @ORM\OneToMany(targetEntity=ControlVehicles::class, mappedBy="vehicles")
     */
    private $controlVehicle;

    /**
     * @ORM\OneToMany(targetEntity=ReportVehicle::class, mappedBy="vehicles")
     */
    private $reportVehicle;

    /**
     * @ORM\Column(type="date")
     */
    private $dateCt;

    /**
     * @ORM\Column(type="date")
     */
    private $dateEntretien;

    public function __construct()
    {
        $this->controlVehicle = new ArrayCollection();
        $this->reportVehicle = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameVehicle(): ?string
    {
        return $this->nameVehicle;
    }

    public function setNameVehicle(string $nameVehicle): self
    {
        $this->nameVehicle = $nameVehicle;

        return $this;
    }

    public function getVehicleMatricule(): ?string
    {
        return $this->vehicleMatricule;
    }

    public function setVehicleMatricule(string $vehicleMatricule): self
    {
        $this->vehicleMatricule = $vehicleMatricule;

        return $this;
    }

    /**
     * @return Collection|ControlVehicles[]
     */
    public function getControlVehicle(): Collection
    {
        return $this->controlVehicle;
    }

    public function addControlVehicle(ControlVehicles $controlVehicle): self
    {
        if (!$this->controlVehicle->contains($controlVehicle)) {
            $this->controlVehicle[] = $controlVehicle;
            $controlVehicle->setVehicles($this);
        }

        return $this;
    }

    public function removeControlVehicle(ControlVehicles $controlVehicle): self
    {
        if ($this->controlVehicle->removeElement($controlVehicle)) {
            // set the owning side to null (unless already changed)
            if ($controlVehicle->getVehicles() === $this) {
                $controlVehicle->setVehicles(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ReportVehicle[]
     */
    public function getReportVehicle(): Collection
    {
        return $this->reportVehicle;
    }

    public function addReportVehicle(ReportVehicle $reportVehicle): self
    {
        if (!$this->reportVehicle->contains($reportVehicle)) {
            $this->reportVehicle[] = $reportVehicle;
            $reportVehicle->setVehicles($this);
        }

        return $this;
    }

    public function removeReportVehicle(ReportVehicle $reportVehicle): self
    {
        if ($this->reportVehicle->removeElement($reportVehicle)) {
            // set the owning side to null (unless already changed)
            if ($reportVehicle->getVehicles() === $this) {
                $reportVehicle->setVehicles(null);
            }
        }

        return $this;
    }

    public function getDateCt(): ?\DateTimeInterface
    {
        return $this->dateCt;
    }

    public function setDateCt(\DateTimeInterface $dateCt): self
    {
        $this->dateCt = $dateCt;

        return $this;
    }

    public function getDateEntretien(): ?\DateTimeInterface
    {
        return $this->dateEntretien;
    }

    public function setDateEntretien(\DateTimeInterface $dateEntretien): self
    {
        $this->dateEntretien = $dateEntretien;

        return $this;
    }
}
