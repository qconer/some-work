<?php

namespace App\Service;

use App\Entity\Game;
use App\Entity\PlayerChoice;
use App\Enum\GameObjectsEnum;

class PlayerChoiceFactory
{
    public function getPlayerChoice(Game $game, string $userSide, bool $allRandom = true): PlayerChoice
    {
        return (new PlayerChoice())
            ->setGame($game)
            ->setChoice($this->getChoice($allRandom))
            ->setPlayerSide($userSide);
    }

    private function getChoice(bool $allRandom = true): string
    {
        $gameObject = GameObjectsEnum::getAll();
        return $allRandom ?
            $gameObject[rand(0, count($gameObject) - 1 )] : // array_rand?
            GameObjectsEnum::PAPER ; // это не гибко. что если мне нужна новая стратегия (например только ROCK)?
    }
}