<?php

namespace App\Service\GameStrategies;

use App\Enum\GameObjectsEnum;
use App\Exception\ChoiceException;
use App\Interfaces\GameStrategyInterface;
use App\Trait\ChoiceValidator;

class ScissorsStrategy implements GameStrategyInterface
{
    use ChoiceValidator;

    /**
     * @throws ChoiceException
     */
    public function execute(string $choice): ?bool
    {
        $this->validate($choice);

        return match ($choice) {
            GameObjectsEnum::SCISSORS => null,
            GameObjectsEnum::STONE => false,
            GameObjectsEnum::PAPER => true,
        };
    }
}