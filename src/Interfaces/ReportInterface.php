<?php

namespace App\Interfaces;

use JetBrains\PhpStorm\Pure;

interface ReportInterface
{
    #[Pure] public function getWinRateLeftPlayer(): float;
    #[Pure] public function getWinRateRightPlayer(): float;
    #[Pure] public function getDrawRating(): float;

    public function getChoiceCountPaper(): int;
    public function getChoiceCountStone(): int;
    public function getChoiceCountScissors(): int;
    public function getWinsCountLeftPlayer(): int;
    public function getWinsCountRightPlayer(): int;
    public function getDrawsCount(): int;
    public function getGameCount(): int;
}