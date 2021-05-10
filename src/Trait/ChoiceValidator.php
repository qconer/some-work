<?php

namespace App\Trait;

use App\Exception\ChoiceException;
use App\Enum\GameObjectsEnum;

trait ChoiceValidator
{
    public function validate(string $currentChoice): void
    {
        if (false === in_array($currentChoice, GameObjectsEnum::getAll())) {
            throw new ChoiceException();
        }
    }
}