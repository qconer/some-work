<?php

namespace App\Service;

use App\Enum\GameObjectsEnum;
use App\Interfaces\GameStrategyInterface;
use App\Service\GameStrategies\PaperStrategy;
use App\Service\GameStrategies\ScissorsStrategy;
use App\Service\GameStrategies\StoneStrategy;
use JetBrains\PhpStorm\Pure;

class StrategyFactory
{
    #[Pure] public function create(string $strategyName): ?GameStrategyInterface // почему nullable? тут какой-то LogicException если пытаемся создать несуществующую strategy. ну или обработку добавить где используется
    {
        return match ($strategyName) {
            GameObjectsEnum::STONE => (new StoneStrategy()),
            GameObjectsEnum::SCISSORS => (new ScissorsStrategy()),
            GameObjectsEnum::PAPER => (new PaperStrategy()),
            default => null
        };
    }
}