<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity=SoundPackage::class, mappedBy="category")
     */
    private $soundPackages;

    public function __construct()
    {
        $this->soundPackages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $soundPackage->setCategory($this);
        }

        return $this;
    }

    public function removeSoundPackage(SoundPackage $soundPackage): self
    {
        if ($this->soundPackages->contains($soundPackage)) {
            $this->soundPackages->removeElement($soundPackage);
            // set the owning side to null (unless already changed)
            if ($soundPackage->getCategory() === $this) {
                $soundPackage->setCategory(null);
            }
        }

        return $this;
    }
}
