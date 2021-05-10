<?php

namespace App\Tests\Service;

use App\Enum\GameObjectsEnum;
use App\Enum\WinnerEnum;
use App\Service\DetermineWinner;
use App\Service\StrategyFactory;
use PHPUnit\Framework\TestCase;

class DetermineWinnerTest extends TestCase
{

    /**
     * @dataProvider dataProvider
     */
    public function testHandler(string $leftUserChoice, string $rightUserChoice, mixed $expected )
    {
        $determinateWinner = new DetermineWinner(new StrategyFactory);
        $winResult = $determinateWinner->handler($leftUserChoice, $rightUserChoice);


        self::assertSame($winResult, $expected);
    }

    public function dataProvider(): array
    {
        return [
            [GameObjectsEnum::STONE, GameObjectsEnum::STONE, WinnerEnum::DRAW],
            [GameObjectsEnum::STONE, GameObjectsEnum::PAPER, WinnerEnum::RIGHT],
            [GameObjectsEnum::STONE, GameObjectsEnum::SCISSORS, WinnerEnum::LEFT],

            [GameObjectsEnum::PAPER, GameObjectsEnum::PAPER, WinnerEnum::DRAW],
            [GameObjectsEnum::PAPER, GameObjectsEnum::SCISSORS, WinnerEnum::RIGHT],

            [GameObjectsEnum::SCISSORS, GameObjectsEnum::SCISSORS, WinnerEnum::DRAW],
        ];
    }
}
