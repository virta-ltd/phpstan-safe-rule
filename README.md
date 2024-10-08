[![Latest Stable Version](https://poser.pugx.org/shish/phpstan-safe-rule/v/stable)](https://packagist.org/packages/shish/phpstan-safe-rule)
[![Total Downloads](https://poser.pugx.org/shish/phpstan-safe-rule/downloads)](https://packagist.org/packages/shish/phpstan-safe-rule)
[![License](https://poser.pugx.org/shish/phpstan-safe-rule/license)](https://packagist.org/packages/shish/phpstan-safe-rule)


PHPStan rules for shish/safe
============================

The [shish/safe](https://github.com/shish/safe) package provides a set of core PHP functions rewritten to throw exceptions instead of returning `false` when an error is encountered.

This PHPStan rule will help you detect unsafe function call and will propose you to use the `shish/safe` variant instead.

Please read [shish/safe documentation](https://github.com/shish/safe) for details about installation and usage.

(This is a fork of `thecodingmachine/phpstan-safe-rule`, with added support for PHP 8)
