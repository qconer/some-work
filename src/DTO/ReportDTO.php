<?php

namespace App\DTO;

use App\Interfaces\ReportInterface;
use JetBrains\PhpStorm\Pure;

class ReportDTO implements ReportInterface
{
    private int $winsCountLeftPlayer;
    private int $winsCountRightPlayer;
    private int $drawsCount;

    private int $gameCount;
    private int $choiceCountPaper;
    private int $choiceCountStone;
    private int $choiceCountScissors;

    private function getReit(int $gamesCount, int $count): float
    {
        return round(($count / $gamesCount) * 100, 2);
    }

    #[Pure] public function getWinRateLeftPlayer(): float
    {
        return $this->getReit($this->gameCount, $this->winsCountLeftPlayer);
    }

    #[Pure] public function getWinRateRightPlayer(): float
    {
        return $this->getReit($this->gameCount, $this->winsCountRightPlayer);
    }

    #[Pure] public function getDrawRating(): float
    {
        return $this->getReit($this->gameCount, $this->drawsCount);
    }

    public function getChoiceCountPaper(): int
    {
        return $this->choiceCountPaper;
    }
    public function getChoiceCountStone(): int
    {
        return $this->choiceCountStone;
    }
    public function getChoiceCountScissors(): int
    {
        return $this->choiceCountScissors;
    }

    public function getWinsCountLeftPlayer(): int
    {
        return $this->winsCountLeftPlayer;
    }
    public function getWinsCountRightPlayer(): int
    {
        return $this->winsCountRightPlayer;
    }public function getDrawsCount(): int
{
    return $this->drawsCount;
}
    public function getGameCount(): int
    {
        return $this->gameCount;
    }

    public function setChoiceCountPaper(int $choiceCountPaper): ReportDTO
    {
        $this->choiceCountPaper = $choiceCountPaper;
        return $this;
    }

    public function setChoiceCountStone(int $choiceCountStone): ReportDTO
    {
        $this->choiceCountStone = $choiceCountStone;
        return $this;
    }

    public function setChoiceCountScissors(int $choiceCountScissors): ReportDTO
    {
        $this->choiceCountScissors = $choiceCountScissors;
        return $this;
    }

    public function setWinsCountLeftPlayer(int $winsCountLeftPlayer): ReportDTO
    {
        $this->winsCountLeftPlayer = $winsCountLeftPlayer;
        return $this;
    }

    public function setWinsCountRightPlayer(int $winsCountRightPlayer): ReportDTO
    {
        $this->winsCountRightPlayer = $winsCountRightPlayer;
        return $this;
    }

    public function setDrawsCount(int $drawsCount): ReportDTO
    {
        $this->drawsCount = $drawsCount;
        return $this;
    }

    public function setGameCount(int $gameCount): ReportDTO
    {
        $this->gameCount = $gameCount;
        return $this;
    }
}