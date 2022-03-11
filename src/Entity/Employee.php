<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

// searchClass
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiFilter;

// Order Class
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;

// grouping attributes
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     attributes={"pagination_items_per_page":10},
 *     normalizationContext={"groups"={"employee.read"}}
 * )
 * @ApiFilter(
 *     searchFilter::class,
 *     properties={
 *         "name":SearchFilter::STRATEGY_PARTIAL,
 *         "departemen.departemen_code":SearchFilter::STRATEGY_EXACT
 *     }  
 * )
 * @ApiFilter(
 *     OrderFilter::class,
 *     properties={
 *         "name"
 *     },  
 * )
 * @ORM\Entity()
 */
#[ApiResource(collectionOperations: ['get', 'post'], itemOperations: ['get', 'put', 'patch'])]
class Employee
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     * @assert\NotBlank()
     * @Groups("employee.read")
     */
    private $nik;

    /**
     * @ORM\Column(type="string", length=100)
     * @assert\NotBlank()
     * @Groups("employee.read")
     */
    private $name;

    /**
     * @ORM\Column(type="date")
     * @assert\NotNull()
     * @Groups("employee.read")
     */
    private $dateofbirth;

    /**
     * @ORM\ManyToOne(targetEntity=Departemen::class, inversedBy="employees")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"employee.read"})
     */
    private $departemen;

    /**
     * @ORM\OneToOne(targetEntity=Unit::class, inversedBy="employee", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $unit_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNik(): ?string
    {
        return $this->nik;
    }

    public function setNik(string $nik): self
    {
        $this->nik = $nik;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDateofbirth(): ?\DateTimeInterface
    {
        return $this->dateofbirth;
    }

    public function setDateofbirth(\DateTimeInterface $dateofbirth): self
    {
        $this->dateofbirth = $dateofbirth;

        return $this;
    }

    public function getDepartemen(): ?Departemen
    {
        return $this->departemen;
    }

    public function setDepartemen(?Departemen $departemen): self
    {
        $this->departemen = $departemen;

        return $this;
    }

    public function getUnitId(): ?Unit
    {
        return $this->unit_id;
    }

    public function setUnitId(Unit $unit_id): self
    {
        $this->unit_id = $unit_id;

        return $this;
    }
}
