<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use App\Repository\DepartemenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

// searchClass
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiFilter;

// grouping attributes
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={"get","post"},
 *     itemOperations={"get","patch"},
 *     normalizationContext={"groups"={"employee.read"}}
 * )
 * 
 * @ApiFilter(
 *     searchFilter::class,
 *     properties={"departemen_name":SearchFilter::STRATEGY_PARTIAL}
 * )
 * @ORM\Entity(repositoryClass=DepartemenRepository::class)
 */

class Departemen
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @assert\NotBlank()
     * @Groups("employee.read")
     */
    #[Assert\NotBlank]
    private $departemen_name;

    /**
     * @ORM\Column(type="string", length=20)
     * @assert\NotBlank()
     * 
     */
    #[Assert\NotBlank]
    private $departemen_code;

    /**
     * @var Employee[] available employee from this departemen
     * @ORM\OneToMany(
     *      targetEntity=Employee::class, 
     *      mappedBy="departemen")
     */
    private iterable $employees;

    public function __construct()
    {
        $this->employees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDepartemenName(): ?string
    {
        return $this->departemen_name;
    }

    public function setDepartemenName(string $departemen_name): self
    {
        $this->departemen_name = $departemen_name;

        return $this;
    }

    public function getDepartemenCode(): ?string
    {
        return $this->departemen_code;
    }

    public function setDepartemenCode(string $departemen_code): self
    {
        $this->departemen_code = $departemen_code;

        return $this;
    }

    /**
     * @return Collection<int, Employee>
     */
    public function getEmployees(): Collection
    {
        return $this->employees;
    }

    public function addEmployee(Employee $employee): self
    {
        if (!$this->employees->contains($employee)) {
            $this->employees[] = $employee;
            $employee->setDepartemen($this);
        }

        return $this;
    }

    public function removeEmployee(Employee $employee): self
    {
        if ($this->employees->removeElement($employee)) {
            // set the owning side to null (unless already changed)
            if ($employee->getDepartemen() === $this) {
                $employee->setDepartemen(null);
            }
        }

        return $this;
    }
}
