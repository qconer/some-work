<?php

namespace App\Tests\Service;

use App\Entity\Game;
use App\Enum\GameObjectsEnum;
use App\Enum\UserSideEnum;
use App\Service\PlayerChoiceFactory;
use PHPUnit\Framework\TestCase;

class PlayerChoiceFactoryTest extends TestCase
{
    private PlayerChoiceFactory $playerChoiceFactory;
    private Game $game;

    protected function setUp(): void
    {
        $this->playerChoiceFactory = new PlayerChoiceFactory;
        $this->game = new Game();
    }

    public function testGetPlayerChoiceRandom()
    {
        $playerChoice =  $this->playerChoiceFactory->getPlayerChoice($this->game, UserSideEnum::LEFT, true);
        self::assertContains($playerChoice->getChoice(), GameObjectsEnum::getAll());
        self::assertSame($playerChoice->getPlayerSide(), UserSideEnum::LEFT);
        self::assertInstanceOf(Game::class, $playerChoice->getGame());
    }

    public function testGetPlayerChoice()
    {
        $playerChoice =  $this->playerChoiceFactory->getPlayerChoice($this->game, UserSideEnum::LEFT, false);
        self::assertSame($playerChoice->getChoice(), GameObjectsEnum::PAPER);
        self::assertSame($playerChoice->getPlayerSide(), UserSideEnum::LEFT);
        self::assertInstanceOf(Game::class, $playerChoice->getGame());
    }
}
