<?php

namespace App\Entity;

use App\Repository\PersonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonRepository::class)
 */
class Person
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $PersonName;

    /**
     * @ORM\Column(type="integer")
     */
    private $PersonAge;

    /**
     * @ORM\OneToOne(targetEntity=PersonDetail::class, mappedBy="Person", cascade={"persist", "remove"})
     */
    private $personDetail;

    /**
     * @ORM\OneToMany(targetEntity=Car::class, mappedBy="Person")
     */
    private $cars;

    /**
     * @ORM\ManyToMany(targetEntity=Job::class, mappedBy="Person")
     */
    private $jobs;

    public function __construct()
    {
        $this->cars = new ArrayCollection();
        $this->jobs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPersonName(): ?string
    {
        return $this->PersonName;
    }

    public function setPersonName(string $PersonName): self
    {
        $this->PersonName = $PersonName;

        return $this;
    }

    public function getPersonAge(): ?int
    {
        return $this->PersonAge;
    }

    public function setPersonAge(int $PersonAge): self
    {
        $this->PersonAge = $PersonAge;

        return $this;
    }

    public function getPersonDetail(): ?PersonDetail
    {
        return $this->personDetail;
    }

    public function setPersonDetail(PersonDetail $personDetail): self
    {
        // set the owning side of the relation if necessary
        if ($personDetail->getPerson() !== $this) {
            $personDetail->setPerson($this);
        }

        $this->personDetail = $personDetail;

        return $this;
    }

    /**
     * @return Collection|Car[]
     */
    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function addCar(Car $car): self
    {
        if (!$this->cars->contains($car)) {
            $this->cars[] = $car;
            $car->setPerson($this);
        }

        return $this;
    }

    public function removeCar(Car $car): self
    {
        if ($this->cars->removeElement($car)) {
            // set the owning side to null (unless already changed)
            if ($car->getPerson() === $this) {
                $car->setPerson(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Job[]
     */
    public function getJobs(): Collection
    {
        return $this->jobs;
    }

    public function addJob(Job $job): self
    {
        if (!$this->jobs->contains($job)) {
            $this->jobs[] = $job;
            $job->addPerson($this);
        }

        return $this;
    }

    public function removeJob(Job $job): self
    {
        if ($this->jobs->removeElement($job)) {
            $job->removePerson($this);
        }

        return $this;
    }
}
