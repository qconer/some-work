<?php

// declare(strict_types=1)

namespace App\Service\GameStrategies;

use App\Enum\GameObjectsEnum;
use App\Exception\ChoiceException;
use App\Interfaces\GameStrategyInterface;
use App\Trait\ChoiceValidator;

class PaperStrategy implements GameStrategyInterface
{
    use ChoiceValidator;

    /**
     * @throws ChoiceException
     */
    public function execute(string $choice): ?bool
    {
        $this->validate($choice);

        return match ($choice) {
            GameObjectsEnum::PAPER => null,
            GameObjectsEnum::STONE => true,
            GameObjectsEnum::SCISSORS => false
        };
    }
}