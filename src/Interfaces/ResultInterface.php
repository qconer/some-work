<?php

namespace App\Interfaces;

interface ResultInterface
{
    public function getResult(): ?string;
    public function getUserSide(): ?string;
}