<?php

namespace App\Entity;

use App\Repository\ReportVehicleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReportVehicleRepository::class)
 */
class ReportVehicle
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
    private $reportVehicle;

    /**
     * @ORM\ManyToOne(targetEntity=Vehicles::class, inversedBy="reportVehicle")
     */
    private $vehicles;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reportVehicles")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReportVehicle(): ?string
    {
        return $this->reportVehicle;
    }

    public function setReportVehicle(string $reportVehicle): self
    {
        $this->reportVehicle = $reportVehicle;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
