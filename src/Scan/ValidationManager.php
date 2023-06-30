<?php
/*
 * Copyright (c) 2023. ogg. Inc. All Rights Reserved.
 * ogg sit down and start building bugs in sunny weather.
 * Author: Ogg <baoziyoo@gmail.com>.
 * LastChangeTime: 2023-01-16 04:03:59
 * ChangeTime: 2023-04-26 10:21:32
 */

declare(strict_types=1);

namespace Baoziyoo\Hyperf\DTO\Validation\Scan;

class ValidationManager
{
    /** @var array<string,mixed> */
    protected static array $content = [];

    public static function setRule(string $className, string $fieldName, array $rule): void
    {
        $className = trim($className, '\\');
        static::$content[$className]['rule'][$fieldName] = $rule;
    }

    public static function setMessages(string $className, string $key, string $messages): void
    {
        $className = trim($className, '\\');
        static::$content[$className]['messages'][$key] = $messages;
    }

    public static function setAttributes(string $className, string $fieldName, string $value): void
    {
        $className = trim($className, '\\');
        static::$content[$className]['attributes'][$fieldName] = $value;
    }

    public static function getData(string $className): array
    {
        $className = trim($className, '\\');
        return static::$content[$className] ?? [];
    }
}
