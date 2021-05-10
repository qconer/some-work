<?php

namespace App\Tests\Service;

use App\Enum\GameObjectsEnum;
use App\Service\GameStrategies\PaperStrategy;
use App\Service\GameStrategies\ScissorsStrategy;
use App\Service\GameStrategies\StoneStrategy;
use App\Service\StrategyFactory;
use PHPUnit\Framework\TestCase;

class StrategyFactoryTest extends TestCase
{
    /**
     * @dataProvider data
     */
    public function testCreate(string $strategyName, string $expected)
    {
        $strategy = (new StrategyFactory())->create($strategyName);

        self::assertInstanceOf($expected, $strategy);
    }

    public function data(): array
    {
        return [
            [GameObjectsEnum::STONE, StoneStrategy::class],
            [GameObjectsEnum::SCISSORS, ScissorsStrategy::class],
            [GameObjectsEnum::PAPER, PaperStrategy::class],
        ];
    }

    /**
     * @dataProvider dataNegative
     */
    public function testCreateNegative(string $strategyName)
    {
        $strategy = (new StrategyFactory())->create($strategyName);

        self::assertNull($strategy);
    }

    public function dataNegative(): array
    {
        return [
            ['someStrategy'],
            ['unknown'],
        ];
    }
}
