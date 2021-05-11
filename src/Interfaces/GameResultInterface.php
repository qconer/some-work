<?php


namespace App\Interfaces;


interface GameResultInterface // мусор? никто не имплементирует
{
    public function getGameNumber(): int;
    public function getLeftPlayerChoice(): string;
    public function getRightPlayerChoice(): string;
    public function getWinner(): ?string;
}