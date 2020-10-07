<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SoundFileRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ApiResource
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
