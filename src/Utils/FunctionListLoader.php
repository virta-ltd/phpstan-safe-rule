<?php

namespace TheCodingMachine\Safe\PHPStan\Utils;

class FunctionListLoader
{
    /**
     * @var string[]
     */
    private static $functions;

    /**
     * @return string[]
     */
    public static function getFunctionList(): array
    {
        if (self::$functions === null) {
            if (\file_exists(__DIR__.'/../../../safe/generated/functionsList.php')) {
                $functions = require __DIR__.'/../../../safe/generated/functionsList.php';
            } elseif (\file_exists(__DIR__.'/../../vendor/shish/safe/generated/functionsList.php')) {
                $functions = require __DIR__.'/../../vendor/shish/safe/generated/functionsList.php';
            } else {
                throw new \RuntimeException('Could not find shish/safe\'s functionsList.php file.');
            }
            // Let's index these functions by their name
            self::$functions = \Safe\array_combine($functions, $functions);
        }
        return self::$functions;
    }
}
