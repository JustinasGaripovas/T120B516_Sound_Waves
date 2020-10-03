<?php

namespace App\Entity;

use App\Repository\SoundPackageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SoundPackageRepository::class)
 */
class SoundPackage
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
    private $soundFilepath;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSoundFilepath(): ?string
    {
        return $this->soundFilepath;
    }

    public function setSoundFilepath(string $soundFilepath): self
    {
        $this->soundFilepath = $soundFilepath;

        return $this;
    }
}
