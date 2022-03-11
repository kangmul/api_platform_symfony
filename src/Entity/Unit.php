<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UnitRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=UnitRepository::class)
 */
class Unit
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
    private $unit;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $unit_code;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $unit_description;

    /**
     * @var Employee[]
     * @ORM\OneToOne(
     *  targetEntity=Employee::class, 
     *  mappedBy="unit_id", 
     *  cascade={"persist", "remove"}
     * )
     */
    private iterable $employee;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): self
    {
        $this->unit = $unit;

        return $this;
    }

    public function getUnitCode(): ?string
    {
        return $this->unit_code;
    }

    public function setUnitCode(string $unit_code): self
    {
        $this->unit_code = $unit_code;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUnitDescription(): ?string
    {
        return $this->unit_description;
    }

    public function setUnitDescription(?string $unit_description): self
    {
        $this->unit_description = $unit_description;

        return $this;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(Employee $employee): self
    {
        // set the owning side of the relation if necessary
        if ($employee->getUnitId() !== $this) {
            $employee->setUnitId($this);
        }

        $this->employee = $employee;

        return $this;
    }
}
