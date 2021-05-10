<?php


namespace App\Interfaces;


interface GameResultInterface
{
    public function getGameNumber(): int;
    public function getLeftPlayerChoice(): string;
    public function getRightPlayerChoice(): string;
    public function getWinner(): ?string;
}