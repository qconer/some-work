<?php

namespace App\Enum;

use App\Interfaces\EnumInterface;
use ReflectionClass;

class BaseEnum implements EnumInterface
{
    public static function getAll(): array
    {
        $enumClass = new ReflectionClass(static::class); // рефлексия это дорого
        return array_values($enumClass->getConstants()); // private/protected тоже потянет. если уже пошел через рефлексию, то ReflectionClassConstant::IS_PUBLIC фильтр хотя-бы
    }
}