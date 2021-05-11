<?php

namespace App\Entity;

use App\Repository\GameSetRepository;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameSetRepository::class)
 */
class GameSet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $start;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private DateTimeInterface $finish; // нету дефолтного значения. (new GameSet())->getFinish() даст ошибку

    /**
     * @ORM\Column(type="integer")
     */
    private int $gameCount;

    /**
     * @ORM\OneToMany(targetEntity=Game::class, mappedBy="gameSet")
     */
    private Collection $games;

    public function __construct()
    {
        $this->games = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getStart(): ?DateTimeInterface
    {
        return $this->start;
    }

    /**
     * @throws \Exception // почему?
     */
    public function setStart(DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getFinish(): ?DateTimeInterface // не nullable судя по декларации
    {
        return $this->finish;
    }

    public function setFinish(?DateTimeInterface $finish): self
    {
        $this->finish = $finish;

        return $this;
    }

    public function getGameCount(): ?int // почему nullable? у тебя же private int $gameCount
    {
        return $this->gameCount;
    }

    public function setGameCount(int $gameCount): self
    {
        $this->gameCount = $gameCount;

        return $this;
    }

    /**
     * @return Collection|Game[]
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): self
    {
        if (!$this->games->contains($game)) {
            $this->games[] = $game;
            $game->setGameSet($this);
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getGameSet() === $this) {
                $game->setGameSet(null);
            }
        }

        return $this;
    }
}
