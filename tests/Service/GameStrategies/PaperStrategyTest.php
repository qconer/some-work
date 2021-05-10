<?php

namespace App\Tests\Service\GameStrategies;

use App\Enum\GameObjectsEnum;
use App\Exception\ChoiceException;
use App\Service\GameStrategies\PaperStrategy;
use PHPUnit\Framework\TestCase;

class PaperStrategyTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testExecute(string $choice, mixed $expected)
    {
        $result = (new PaperStrategy())->execute($choice);
        self::assertSame($expected, $result);
    }

    public function dataProvider(): array
    {
        return [
            [GameObjectsEnum::PAPER, null],
            [GameObjectsEnum::STONE, true],
            [GameObjectsEnum::SCISSORS, false],
        ];
    }

    public function testExecuteNegative()
    {
        $this->expectException(ChoiceException::class);
        (new PaperStrategy())->execute('unknown');
    }
}
