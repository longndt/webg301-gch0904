<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmployeeRepository::class)
 */
class Employee
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
    private $EmployeeName;

    /**
     * @ORM\Column(type="integer")
     */
    private $EmployeeAge;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $EmployeeMobile;

    /**
     * @ORM\Column(type="string", length=155, nullable=true)
     */
    private $EmployeeAddress;

    /**
     * @ORM\Column(type="float")
     */
    private $EmployeeSalary;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $EmployeeBirthday;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmployeeName(): ?string
    {
        return $this->EmployeeName;
    }

    public function setEmployeeName(string $EmployeeName): self
    {
        $this->EmployeeName = $EmployeeName;

        return $this;
    }

    public function getEmployeeAge(): ?int
    {
        return $this->EmployeeAge;
    }

    public function setEmployeeAge(int $EmployeeAge): self
    {
        $this->EmployeeAge = $EmployeeAge;

        return $this;
    }

    public function getEmployeeMobile(): ?string
    {
        return $this->EmployeeMobile;
    }

    public function setEmployeeMobile(?string $EmployeeMobile): self
    {
        $this->EmployeeMobile = $EmployeeMobile;

        return $this;
    }

    public function getEmployeeAddress(): ?string
    {
        return $this->EmployeeAddress;
    }

    public function setEmployeeAddress(string $EmployeeAddress): self
    {
        $this->EmployeeAddress = $EmployeeAddress;

        return $this;
    }

    public function getEmployeeSalary(): ?float
    {
        return $this->EmployeeSalary;
    }

    public function setEmployeeSalary(float $EmployeeSalary): self
    {
        $this->EmployeeSalary = $EmployeeSalary;

        return $this;
    }

    public function getEmployeeBirthday(): ?\DateTimeInterface
    {
        return $this->EmployeeBirthday;
    }

    public function setEmployeeBirthday(?\DateTimeInterface $EmployeeBirthday): self
    {
        $this->EmployeeBirthday = $EmployeeBirthday;

        return $this;
    }
}
