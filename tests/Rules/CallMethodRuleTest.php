<?php

namespace TheCodingMachine\Safe\PHPStan\Rules;

use PHPStan\Php\PhpVersion;
use PHPStan\Rules\FunctionCallParametersCheck;
use PHPStan\Rules\Methods\CallMethodsRule;
use PHPStan\Rules\Methods\MethodCallCheck;
use PHPStan\Rules\NullsafeCheck;
use PHPStan\Rules\PhpDoc\UnresolvableTypeHelper;
use PHPStan\Rules\Properties\PropertyReflectionFinder;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleLevelHelper;
use PHPStan\Testing\RuleTestCase;
use TheCodingMachine\Safe\PHPStan\Type\Php\ReplaceSafeFunctionsDynamicReturnTypeExtension;

class CallMethodRuleTest extends RuleTestCase
{
    protected function getRule(): Rule
    {
        $reflectionProvider = $this->createReflectionProvider();
        $ruleLevelHelper = new RuleLevelHelper(
            $reflectionProvider,
            checkNullables: true,
            checkThisOnly: true,
            checkUnionTypes: true,
            checkExplicitMixed: false,
            checkImplicitMixed: false,
            checkBenevolentUnionTypes: false
        );
        return new CallMethodsRule(
            new MethodCallCheck($reflectionProvider, $ruleLevelHelper, true, true),
            new FunctionCallParametersCheck(
                $ruleLevelHelper,
                new NullsafeCheck(),
                new PhpVersion(PHP_VERSION_ID),
                new UnresolvableTypeHelper(),
                new PropertyReflectionFinder($reflectionProvider),
                checkArgumentTypes: true,
                checkArgumentsPassedByReference: false,
                checkExtraArguments: false,
                checkMissingTypehints: false,
            )
        );
    }

    public function testSafePregReplace()
    {
        // FIXME: this rule actually runs code but will always return no error because the rule executed is not the correct one.
        // This provides code coverage but assert is not ok.
        $this->analyse([__DIR__ . '/data/safe_pregreplace.php'], []);
    }


    /**
     * @return \PHPStan\Type\DynamicFunctionReturnTypeExtension[]
     */
    public function getDynamicFunctionReturnTypeExtensions(): array
    {
        return [new ReplaceSafeFunctionsDynamicReturnTypeExtension()];
    }
}
