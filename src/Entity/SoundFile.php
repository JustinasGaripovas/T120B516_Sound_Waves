<?php

namespace App\Entity;

use App\Repository\SoundFileRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SoundFileRepository::class)
 */
class SoundFile
{
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
}
