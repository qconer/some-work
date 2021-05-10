<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Enum\WinnerEnum;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Choice(callback={"WinnerEnum", "getAll"}, message="Choose a valid winner type")
     */
    private string $winner;

    /**
     * @ORM\ManyToOne(targetEntity=GameSet::class, inversedBy="games")
     * @ORM\JoinColumn(nullable=false)
     */
    private GameSet $gameSet;

    /**
     * @ORM\OneToMany(targetEntity=PlayerChoice::class, mappedBy="game")
     */
    private Collection $playerChoices;

    public function __construct()
    {
        $this->playerChoices = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getWinner(): ?string
    {
        return $this->winner;
    }

    public function setWinner(string $winner): self
    {
        $this->winner = $winner;

        return $this;
    }

    public function getGameSet(): GameSet
    {
        return $this->gameSet;
    }

    public function setGameSet(GameSet $gameSet): self
    {
        $this->gameSet = $gameSet;

        return $this;
    }

    /**
     * @return Collection|PlayerChoice[]
     */
    public function getPlayerChoices(): Collection
    {
        return $this->playerChoices;
    }

    public function addPlayerChoice(PlayerChoice $playerChoice): self
    {
        if (!$this->playerChoices->contains($playerChoice)) {
            $this->playerChoices[] = $playerChoice;
            $playerChoice->setGame($this);
        }

        return $this;
    }

    public function removePlayerChoice(PlayerChoice $playerChoice): self
    {
        if ($this->playerChoices->removeElement($playerChoice)) {
            // set the owning side to null (unless already changed)
            if ($playerChoice->getGame() === $this) {
                $playerChoice->setGame(null);
            }
        }

        return $this;
    }
}
