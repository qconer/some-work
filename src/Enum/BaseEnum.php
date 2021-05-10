<?php

namespace App\Enum;

use App\Interfaces\EnumInterface;
use ReflectionClass;

class BaseEnum implements EnumInterface
{
    public static function getAll(): array
    {
        $enumClass = new ReflectionClass(static::class);
        return array_values($enumClass->getConstants());
    }
}