<?php
declare(strict_types=1);

namespace Utils\PHPStan;

use PhpParser\Node;
use PhpParser\Node\Expr\Exit_;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

/**
 * @implements Rule<Exit_>
 */
final class NoExitRule implements Rule
{
    public function getNodeType(): string
    {
        // What node type is this rule interested in? For now: any node type
        return Exit_::class;
    }

    /**
     * @param Node $node
     */
    public function processNode(Node $node, Scope $scope): array
    {
        return [
            RuleErrorBuilder::message('exit() is not allowed')->build()
        ];
    }
}
