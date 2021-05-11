<?php

namespace App\Entity;

use App\Repository\PlayerChoiceRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Enum\UserSideEnum;
use App\Enum\GameObjectsEnum;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PlayerChoiceRepository::class)
 */
class PlayerChoice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Choice(callback={"GameObjectsEnum", "getAll"}, message="Choose a valid game object")
     */
    private string $choice;

    /**
     * @ORM\ManyToOne(targetEntity=Game::class, inversedBy="playerChoices")
     */
    private Game $game;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\Choice(callback={"UserSideEnum", "getAll"}, message="Choose a valid user side")
     */
    private string $playerSide;

    public function getPlayerSide(): string
    {
        return $this->playerSide;
    }

    public function setPlayerSide(string $playerSide): PlayerChoice // :self. причем в некоторых классах норм, а тут className
    {
        $this->playerSide = $playerSide;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getChoice(): ?string
    {
        return $this->choice;
    }

    public function setChoice(string $choice): self
    {
        $this->choice = $choice;

        return $this;
    }

    public function getGame(): Game
    {
        return $this->game;
    }

    public function setGame(Game $game): self
    {
        $this->game = $game;

        return $this;
    }
}
