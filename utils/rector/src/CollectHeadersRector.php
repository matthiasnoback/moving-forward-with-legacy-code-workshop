<?php
declare(strict_types=1);

namespace Utils\Rector;

use PhpParser\Node;
use PhpParser\Node\Expr\ArrayDimFetch;
use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Expr\Closure;
use PhpParser\Node\Expr\FuncCall;
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

    private function refactorFuncCall(FuncCall $node): ?Assign
    {
        if (!$this->isName($node, 'header')) {
            return null;
        }

        return new Assign(
            new ArrayDimFetch(new Node\Expr\Variable('headers')),
            // We ignore additional arguments for now
            $node->args[0]->value
        );
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Collect headers', []);
    }

    private function refactorClosure(Closure $node): ?Closure
    {
        if (count($node->params) > 0) {
            // the closure already has arguments, probably `&$headers`
            return null;
        }

        $node->params[] = new Node\Param(
            new Node\Expr\Variable('headers'),
            null,
            new Node\Identifier('array'),
            true
        );

        return $node;
    }
}
