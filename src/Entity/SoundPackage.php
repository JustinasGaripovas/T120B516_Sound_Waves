<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SoundPackageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}}
 * )
 *
 * @ORM\Entity(repositoryClass=SoundPackageRepository::class)
 */
class SoundPackage
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
     * @Groups({"write"})
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="soundPackages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $createdBy;

    /**
     * @Groups({"write"})
     * @ORM\OneToMany(targetEntity=SoundFile::class, mappedBy="soundPackage")
     */
    private $soundFiles;

    /**
     * @Groups({"write", "read"})
     * @ORM\ManyToOne(targetEntity=SoundPackage::class, inversedBy="childSoundPackages")
     */
    private $soundPackage;

    /**
     * @Groups({"write"})
     * @ORM\OneToMany(targetEntity=SoundPackage::class, mappedBy="soundPackage")
     */
    private $childSoundPackages;

    /**
     * @Groups({"write", "read"})
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @Groups({"write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    public function __construct()
    {
        $this->soundFiles = new ArrayCollection();
        $this->childSoundPackages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return Collection|SoundFile[]
     */
    public function getSoundFiles(): Collection
    {
        return $this->soundFiles;
    }

    public function addSoundFile(SoundFile $soundFile): self
    {
        if (!$this->soundFiles->contains($soundFile)) {
            $this->soundFiles[] = $soundFile;
            $soundFile->setSoundPackage($this);
        }

        return $this;
    }

    public function removeSoundFile(SoundFile $soundFile): self
    {
        if ($this->soundFiles->contains($soundFile)) {
            $this->soundFiles->removeElement($soundFile);
            // set the owning side to null (unless already changed)
            if ($soundFile->getSoundPackage() === $this) {
                $soundFile->setSoundPackage(null);
            }
        }

        return $this;
    }

    public function getSoundPackage(): ?self
    {
        return $this->soundPackage;
    }

    public function setSoundPackage(?self $soundPackage): self
    {
        $this->soundPackage = $soundPackage;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getChildSoundPackages(): Collection
    {
        return $this->childSoundPackages;
    }

    public function addChildSoundPackage(self $childSoundPackage): self
    {
        if (!$this->childSoundPackages->contains($childSoundPackage)) {
            $this->childSoundPackages[] = $childSoundPackage;
            $childSoundPackage->setSoundPackage($this);
        }

        return $this;
    }

    public function removeChildSoundPackage(self $childSoundPackage): self
    {
        if ($this->childSoundPackages->contains($childSoundPackage)) {
            $this->childSoundPackages->removeElement($childSoundPackage);
            // set the owning side to null (unless already changed)
            if ($childSoundPackage->getSoundPackage() === $this) {
                $childSoundPackage->setSoundPackage(null);
            }
        }

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
