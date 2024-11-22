<?php

namespace TheCodingMachine\Safe\PHPStan\Rules;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;
use PHPStan\Rules\RuleErrors\RuleError117;
use PHPStan\ShouldNotHappenException;
use TheCodingMachine\Safe\PHPStan\Utils\ClassListLoader;

/**
 * This rule checks that no "unsafe" classes are instantiated in code.
 *
 * @implements Rule<Node\Expr\New_>
 */
class UseSafeClassesRule implements Rule
{
    public function getNodeType(): string
    {
        return Node\Expr\New_::class;
    }

    /**
     * @param Node\Expr\New_ $node
     * @param \PHPStan\Analyser\Scope $scope
     * @return string[]
     * @throws ShouldNotHappenException
     */
    public function processNode(Node $node, Scope $scope): array
    {
        $classNode = $node->class;
        if (!$classNode instanceof Node\Name) {
            return [];
        }

        $className = $classNode->toString();
        $unsafeClasses = ClassListLoader::getClassList();

        if (isset($unsafeClasses[$className])) {

            return [RuleErrorBuilder::message(
                "Class $className is unsafe to use. Its methods can return FALSE instead of throwing an exception. Please add 'use Safe\\$className;' at the beginning of the file to use the variant provided by the 'shish/safe' library."
            )->file($scope->getFile())->line($node->getLine())->build()];
        }

        return [];
    }
}
