<?php

namespace App\Entity;

use App\Repository\JobRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JobRepository::class)
 */
class Job
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $JobName;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $JobCompany;

    /**
     * @ORM\Column(type="float")
     */
    private $Salary;

    /**
     * @ORM\ManyToMany(targetEntity=Person::class, inversedBy="jobs")
     */
    private $Person;

    public function __construct()
    {
        $this->Person = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJobName(): ?string
    {
        return $this->JobName;
    }

    public function setJobName(string $JobName): self
    {
        $this->JobName = $JobName;

        return $this;
    }

    public function getJobCompany(): ?string
    {
        return $this->JobCompany;
    }

    public function setJobCompany(string $JobCompany): self
    {
        $this->JobCompany = $JobCompany;

        return $this;
    }

    public function getSalary(): ?float
    {
        return $this->Salary;
    }

    public function setSalary(float $Salary): self
    {
        $this->Salary = $Salary;

        return $this;
    }

    /**
     * @return Collection|Person[]
     */
    public function getPerson(): Collection
    {
        return $this->Person;
    }

    public function addPerson(Person $person): self
    {
        if (!$this->Person->contains($person)) {
            $this->Person[] = $person;
        }

        return $this;
    }

    public function removePerson(Person $person): self
    {
        $this->Person->removeElement($person);

        return $this;
    }
}
