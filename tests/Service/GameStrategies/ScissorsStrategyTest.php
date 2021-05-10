<?php

namespace App\Tests\Service\GameStrategies;

use App\Enum\GameObjectsEnum;
use App\Exception\ChoiceException;
use App\Service\GameStrategies\PaperStrategy;
use App\Service\GameStrategies\ScissorsStrategy;
use App\Service\GameStrategies\StoneStrategy;
use PHPUnit\Framework\TestCase;

class ScissorsStrategyTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testExecute(string $choice, mixed $expected)
    {
        $result = (new ScissorsStrategy())->execute($choice);
        self::assertSame($expected, $result);
    }

    public function dataProvider(): array
    {
        return [
            [GameObjectsEnum::PAPER, true],
            [GameObjectsEnum::SCISSORS, null],
            [GameObjectsEnum::STONE, false],
        ];
    }

    public function testExecuteNegative()
    {
        $this->expectException(ChoiceException::class);
        (new PaperStrategy())->execute('unknown');
    }
}
