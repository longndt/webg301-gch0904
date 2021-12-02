<?php

namespace App\Entity;

use App\Repository\PersonDetailRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonDetailRepository::class)
 */
class PersonDetail
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $PersonAddress;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $PersonMobile;

    /**
     * @ORM\Column(type="date")
     */
    private $PersonBirthday;

    /**
     * @ORM\OneToOne(targetEntity=Person::class, inversedBy="personDetail", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Person;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPersonAddress(): ?string
    {
        return $this->PersonAddress;
    }

    public function setPersonAddress(string $PersonAddress): self
    {
        $this->PersonAddress = $PersonAddress;

        return $this;
    }

    public function getPersonMobile(): ?string
    {
        return $this->PersonMobile;
    }

    public function setPersonMobile(string $PersonMobile): self
    {
        $this->PersonMobile = $PersonMobile;

        return $this;
    }

    public function getPersonBirthday(): ?\DateTimeInterface
    {
        return $this->PersonBirthday;
    }

    public function setPersonBirthday(\DateTimeInterface $PersonBirthday): self
    {
        $this->PersonBirthday = $PersonBirthday;

        return $this;
    }

    public function getPerson(): ?Person
    {
        return $this->Person;
    }

    public function setPerson(Person $Person): self
    {
        $this->Person = $Person;

        return $this;
    }
}
