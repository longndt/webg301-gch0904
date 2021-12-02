<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarRepository::class)
 */
class Car
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
    private $CarName;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $CarBrand;

    /**
     * @ORM\Column(type="integer")
     */
    private $CarModel;

    /**
     * @ORM\ManyToOne(targetEntity=Person::class, inversedBy="cars")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Person;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarName(): ?string
    {
        return $this->CarName;
    }

    public function setCarName(string $CarName): self
    {
        $this->CarName = $CarName;

        return $this;
    }

    public function getCarBrand(): ?string
    {
        return $this->CarBrand;
    }

    public function setCarBrand(string $CarBrand): self
    {
        $this->CarBrand = $CarBrand;

        return $this;
    }

    public function getCarModel(): ?int
    {
        return $this->CarModel;
    }

    public function setCarModel(int $CarModel): self
    {
        $this->CarModel = $CarModel;

        return $this;
    }

    public function getPerson(): ?Person
    {
        return $this->Person;
    }

    public function setPerson(?Person $Person): self
    {
        $this->Person = $Person;

        return $this;
    }
}
