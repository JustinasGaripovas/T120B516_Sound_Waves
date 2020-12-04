<?php

namespace App\Entity;

use App\Repository\ScoreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ScoreRepository::class)
 */
class Score
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $score;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="scores")
     */
    private $user_id;

    /**
     * @ORM\ManyToOne(targetEntity=SoundPackage::class, inversedBy="scores")
     */
    private $sound_package_id;


    public function __construct(int $score, User $user)
    {
        $this->score = $score;
        $this->user_id = $user;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function getSoundPackageId(): ?SoundPackage
    {
        return $this->sound_package_id;
    }

    public function setSoundPackageId(?SoundPackage $sound_package_id): self
    {
        $this->sound_package_id = $sound_package_id;

        return $this;
    }
}
