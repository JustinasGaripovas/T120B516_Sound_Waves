<?php

namespace App\Entity;

use App\Repository\SoundFileRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=SoundFileRepository::class)
 * @Gedmo\Uploadable()
 */
class SoundFile
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
     * @ORM\ManyToOne(targetEntity=SoundPackage::class, inversedBy="soundFiles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $soundPackage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $filename;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSoundPackage(): ?SoundPackage
    {
        return $this->soundPackage;
    }

    public function setSoundPackage(?SoundPackage $soundPackage): self
    {
        $this->soundPackage = $soundPackage;

        return $this;
    }

    public function __toString(): string
    {
        return (string)$this->getId();
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
}
