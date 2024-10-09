<?php

namespace TheCodingMachine\Safe\PHPStan\Utils;

class ClassListLoader
{
    /**
     * @var array<class-string,class-string>
     */
    private static $classes = [
        'DateTime' => 'DateTime',
        'DateTimeImmutable' => 'DateTimeImmutable',
    ];

    /**
     * @return class-string[]
     */
    public static function getClassList(): array
    {
        return self::$classes;
    }
}
