<?php

namespace App\Entity;

use App\Repository\SoundPackageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=SoundPackageRepository::class)
 */
class SoundPackage
{
    use SoftDeleteableEntity;
    use TimestampableEntity;

    /**
     * @Groups("music_list")
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="soundPackages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $createdBy;

    /**
     * @Groups("music_list")
     * @ORM\OneToMany(targetEntity=SoundFile::class, mappedBy="soundPackage")
     */
    private $soundFiles;

    /**
     * @Groups("music_list")
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="soundPackages")
     */
    private $category;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 2,
     *      notInRangeMessage = "Level must be between {{ min }} and {{ max }}",
     * )
     */
    private $level;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $filename;

    /**
     * @ORM\OneToMany(targetEntity=Score::class, mappedBy="sound_file")
     */
    private $scores;

    public function __construct()
    {
        $this->soundFiles = new ArrayCollection();
        $this->scores = new ArrayCollection();
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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }
    public function __toString(): string
    {
        return (string)$this->getTitle();
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * @return Collection|Score[]
     */
    public function getScores(): Collection
    {
        return $this->scores;
    }

    public function addScore(Score $score): self
    {
        if (!$this->scores->contains($score)) {
            $this->scores[] = $score;
            $score->setSoundFile($this);
        }

        return $this;
    }

    public function removeScore(Score $score): self
    {
        if ($this->scores->removeElement($score)) {
            // set the owning side to null (unless already changed)
            if ($score->getSoundFile() === $this) {
                $score->setSoundFile(null);
            }
        }

        return $this;
    }
}
