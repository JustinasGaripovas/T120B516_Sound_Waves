<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    use SoftDeleteableEntity;
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $secondName;

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     *
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $passwordEncoded;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $role = [];

    /**
     * @ORM\OneToMany(targetEntity=SoundPackage::class, mappedBy="createdBy")
     */
    private $soundPackages;

    public function __construct()
    {
        $roles[] = 'ROLE_USER';
        $this->soundPackages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSecondName(): ?string
    {
        return $this->secondName;
    }

    public function setSecondName(string $secondName): self
    {
        $this->secondName = $secondName;

        return $this;
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

    public function getPasswordEncoded(): ?string
    {
        return $this->passwordEncoded;
    }

    public function setPasswordEncoded(string $passwordEncoded): self
    {
        $this->passwordEncoded = $passwordEncoded;

        return $this;
    }

    public function getRole(): ?array
    {
        return $this->role;
    }

    public function setRole(array $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection|SoundPackage[]
     */
    public function getSoundPackages(): Collection
    {
        return $this->soundPackages;
    }

    public function addSoundPackage(SoundPackage $soundPackage): self
    {
        if (!$this->soundPackages->contains($soundPackage)) {
            $this->soundPackages[] = $soundPackage;
            $soundPackage->setCreatedBy($this);
        }

        return $this;
    }

    public function removeSoundPackage(SoundPackage $soundPackage): self
    {
        if ($this->soundPackages->contains($soundPackage)) {
            $this->soundPackages->removeElement($soundPackage);
            // set the owning side to null (unless already changed)
            if ($soundPackage->getCreatedBy() === $this) {
                $soundPackage->setCreatedBy(null);
            }
        }

        return $this;
    }
}
