<?php

namespace App\Entity;

use App\Repository\ScoreRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

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
    private $sound_file;


    public function __construct(int $score, UserInterface $user, SoundPackage $soundPackage)
    {
        $this->score = $score;
        $this->user_id = $user;
        $this->sound_file = $soundPackage;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function getUserId(): ?UserInterface
    {
        return $this->user_id;
    }

    public function getSoundFile(): ?SoundPackage
    {
        return $this->sound_file;
    }

    public function setSoundFile(?SoundPackage $sound_file): self
    {
        $this->sound_file = $sound_file;

        return $this;
    }

    public function __toString(): string
    {
        return (string)$this->getScore();
    }
}
