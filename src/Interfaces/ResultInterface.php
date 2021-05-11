<?php

namespace App\Interfaces;

interface ResultInterface // мусор? никто не имплементирует
{
    public function getResult(): ?string;
    public function getUserSide(): ?string;
}