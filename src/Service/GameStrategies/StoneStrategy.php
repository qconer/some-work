<?php

namespace App\Service\GameStrategies;

use App\Enum\GameObjectsEnum;
use App\Exception\ChoiceException;
use App\Interfaces\GameStrategyInterface;
use App\Trait\ChoiceValidator;

class StoneStrategy implements GameStrategyInterface
{
    use ChoiceValidator;

    /**
     * @throws ChoiceException
     */
    public function execute(string $choice): ?bool
    {
        $this->validate($choice);

        return match ($choice) {
            GameObjectsEnum::PAPER => false,
            GameObjectsEnum::STONE => null,
            GameObjectsEnum::SCISSORS => true
        };
    }
}