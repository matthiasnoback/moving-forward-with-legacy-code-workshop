<?php
declare(strict_types=1);

namespace Utils\PHPStan;

use PhpParser\Node\Expr\New_;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

/**
 * @implements Rule<Node\Expr\New_>
 */
final class DynamicInstantiationRule implements Rule
{
    public function getNodeType(): string
    {
        // What node type is this rule interested in? For now: any node type
        return New_::class;
    }

    /**
     * @param Node\Expr\New_ $node
     */
    public function processNode(Node $node, Scope $scope): array
    {
        if (!$node->class instanceof Variable) {
            return [];
        }

        return [
            RuleErrorBuilder::message('Dynamic class instantiation is not allowed')->build()
        ];
    }
}
