<?php

declare(strict_types=1);

namespace Utils\Rector;

use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr\ArrayDimFetch;
use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Expr\Closure;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Identifier;
use PhpParser\Node\Param;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class CollectHeadersRector extends AbstractRector
{
    public function getNodeTypes(): array
    {
        return [FuncCall::class, Closure::class];
    }

    /**
     * @param FuncCall|Closure $node
     */
    public function refactor(Node $node): ?Node
    {
        if ($node instanceof FuncCall) {
            return $this->refactorFuncCall($node);
        }

        return $this->refactorClosure($node);
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Collect headers', []);
    }

    private function refactorFuncCall(FuncCall $node): ?Assign
    {
        if (! $this->isName($node, 'header')) {
            return null;
        }

        if (! $node->args[0] instanceof Arg) {
            return null;
        }

        return new Assign(
            new ArrayDimFetch(new Variable('headers')),
            // We ignore additional arguments for now
            $node->args[0]->value
        );
    }

    private function refactorClosure(Closure $node): ?Closure
    {
        if (count($node->params) > 0) {
            // the closure already has arguments, probably `&$headers`
            return null;
        }

        $node->params[] = new Param(new Variable('headers'), null, new Identifier('array'), true);

        return $node;
    }
}
