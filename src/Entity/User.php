<?php

namespace App\Entity;

use App\Entity\Grade;
use App\Entity\Ranks;
use App\Entity\Fonction;
use App\Entity\RoleCenter;
use App\Entity\Speciality;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    public const ROLE_ADMIN = 'ROLE_ADMIN';
    public const ROLE_ADJOINTCHEFDECENTRE = 'ROLE_ADJOINTCHEFDECENTRE';
    public const ROLE_FORMATEUR = 'ROLE_FORMATEUR';
    public const ROLE_RESPONSABLEPHARMA = 'ROLE_RESPONSABLEPHARMA';
    public const ROLE_RESPONSABLEVEHICULE = 'ROLE_RESPONSABLEVEHICULE';
    public const ROLE_RESPONSABLESPORT = 'ROLE_RESPONSABLESPORT';
    public const ROLE_RESPONSABLELOCATION = 'ROLE_RESPONSABLELOCATION';
    public const ROLE_RESPONSABLECOMMANDE = 'ROLE_RESPONSABLECOMMANDE';
    public const ROLE_RESPONSABLEHABILLEMENT = 'ROLE_RESPONSABLEHABILLEMENT';
    public const ROLE_RESPONSABLEAMICALE = 'ROLE_RESPONSABLEAMICALE';
    public const ROLE_CHEFDEGARDE = 'ROLE_CHEFDEGARDE';
    public const ROLE_USER = 'ROLE_USER';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $phoneNumber;

    /**
     * @ORM\ManyToMany(targetEntity=RoleCenter::class, inversedBy="users")
     */
    private $roleCenter;

    /**
     * @ORM\ManyToOne(targetEntity=Grade::class, inversedBy="users")
     */
    private $grade;

    /**
     * @ORM\ManyToOne(targetEntity=Ranks::class, inversedBy="users")
     */
    private $rank;

    /**
     * @ORM\ManyToOne(targetEntity=Fonction::class, inversedBy="users")
     */
    private $fonction;

    /**
     * @ORM\ManyToMany(targetEntity=Speciality::class, inversedBy="users")
     */
    private $speciality;

    /**
     * @ORM\OneToMany(targetEntity=ReportVehicle::class, mappedBy="user")
     */
    private $reportVehicles;

    public function __construct()
    {               
        $this->roles = [self::ROLE_USER];
        $this->roleCenter = new ArrayCollection();
        $this->speciality = new ArrayCollection();
        $this->reportVehicles = new ArrayCollection();     
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * @return Collection|RoleCenter[]
     */
    public function getRoleCenter(): Collection
    {
        return $this->roleCenter;
    }

    public function addRoleCenter(RoleCenter $roleCenter): self
    {
        if (!$this->roleCenter->contains($roleCenter)) {
            $this->roleCenter[] = $roleCenter;
        }

        return $this;
    }

    public function removeRoleCenter(RoleCenter $roleCenter): self
    {
        $this->roleCenter->removeElement($roleCenter);

        return $this;
    }

    public function getGrade(): ?Grade
    {
        return $this->grade;
    }

    public function setGrade(?Grade $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    public function getRank(): ?Ranks
    {
        return $this->rank;
    }

    public function setRank(?Ranks $rank): self
    {
        $this->rank = $rank;

        return $this;
    }

    public function getFonction(): ?Fonction
    {
        return $this->fonction;
    }

    public function setFonction(?Fonction $fonction): self
    {
        $this->fonction = $fonction;

        return $this;
    }

    /**
     * @return Collection|Speciality[]
     */
    public function getSpeciality(): Collection
    {
        return $this->speciality;
    }

    public function addSpeciality(Speciality $speciality): self
    {
        if (!$this->speciality->contains($speciality)) {
            $this->speciality[] = $speciality;
        }

        return $this;
    }

    public function removeSpeciality(Speciality $speciality): self
    {
        $this->speciality->removeElement($speciality);

        return $this;
    }

    /**
     * @return Collection|ReportVehicle[]
     */
    public function getReportVehicles(): Collection
    {
        return $this->reportVehicles;
    }

    public function addReportVehicle(ReportVehicle $reportVehicle): self
    {
        if (!$this->reportVehicles->contains($reportVehicle)) {
            $this->reportVehicles[] = $reportVehicle;
            $reportVehicle->setUser($this);
        }

        return $this;
    }

    public function removeReportVehicle(ReportVehicle $reportVehicle): self
    {
        if ($this->reportVehicles->removeElement($reportVehicle)) {
            // set the owning side to null (unless already changed)
            if ($reportVehicle->getUser() === $this) {
                $reportVehicle->setUser(null);
            }
        }

        return $this;
    }
}
