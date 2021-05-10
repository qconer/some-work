<?php

namespace App\Interfaces;

use App\Interfaces\ResultInterface;

interface GameStrategyInterface
{
    public function execute(string $choice): ?bool;
}