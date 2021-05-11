<?php

namespace App\Service;

use App\Enum\WinnerEnum;

class DetermineWinner
{
    public function __construct(
        private StrategyFactory $strategyFactory
    ) {}

    public function handler( // при наименовании методов желательно использовать глагол. handle ни о чем не говорит
        string $leftPlayerChoice,
        string $rightPlayerChoice,

    ): ?string {

        $strategy = $this->strategyFactory->create($leftPlayerChoice);

        $result = $strategy->execute($rightPlayerChoice);

        if ($result === null) {
            return WinnerEnum::DRAW;
        }

        return $result ? WinnerEnum::LEFT : WinnerEnum::RIGHT ;
    }
}