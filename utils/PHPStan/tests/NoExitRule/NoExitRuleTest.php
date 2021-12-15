<?php
declare(strict_types=1);

namespace Utils\PHPStan\Tests\NoExitRule;

use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use Utils\PHPStan\NoExitRule;

/**
 * @extends RuleTestCase<NoExitRule>
 */
final class NoExitRuleTest extends RuleTestCase
{
    protected function getRule(): Rule
    {
        return new NoExitRule();
    }

    public function testRulePreventsDynamicInstantiation(): void
    {
        $this->analyse(
            [__DIR__ . '/Fixtures/exit.php'],
            [
                [
                    'exit() is not allowed',
                    3
                ]
            ]
        );
    }
}
