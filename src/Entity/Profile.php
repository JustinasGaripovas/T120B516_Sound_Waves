<?php

namespace App\Entity;

use App\Repository\ProfileRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProfileRepository::class)
 */
class Profile
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gender;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $level;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="profile", cascade={"persist", "remove"})
     */
    private $user_id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isProfessional;

    /**
     * @ORM\Column(type="integer")
     */
    private $timeSingingInYears;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(?string $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getIsProfessional(): ?bool
    {
        return $this->isProfessional;
    }

    public function setIsProfessional(bool $isProfessional): self
    {
        $this->isProfessional = $isProfessional;

        return $this;
    }

    public function getTimeSingingInYears(): ?int
    {
        return $this->timeSingingInYears;
    }

    public function setTimeSingingInYears(int $timeSingingInYears): self
    {
        $this->timeSingingInYears = $timeSingingInYears;

        return $this;
    }
}
