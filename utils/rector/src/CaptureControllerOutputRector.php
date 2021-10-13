<?php

declare(strict_types=1);

namespace Utils\Rector;

use App\Output;
use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr\Closure;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Return_;
use Rector\Core\Rector\AbstractRector;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class CaptureControllerOutputRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Capture and return controller output', []);
    }

    public function getNodeTypes(): array
    {
        return [ClassMethod::class];
    }

    /**
     * @param Node\Stmt\ClassMethod $node
     */
    public function refactor(Node $node): ?Node
    {
        if (! str_ends_with($node->getAttribute(AttributeKey::CLASS_NAME), 'Controller')) {
            return null;
        }

        if (! $node->isPublic()) {
            return null;
        }

        if ($node->stmts === null) {
            return null;
        }

        if ($node->stmts[0] instanceof Return_) {
            // The first statement is a return statement, we assume it doesn't need to be wrapped inside Output::capture()
            return null;
        }

        $outputCaptureCall = new StaticCall(
            new FullyQualified(Output::class),
            new Identifier('capture'),  // Output::capture()
            [
                new Arg(new Closure([
                    // function (): void {}
                    'stmts' => $node->stmts,
                    // existing statements in this controller method,
                    'returnType' => new Identifier('void'),
                ])),
            ]
        );

        $node->stmts = [
            new Return_( // return
                $outputCaptureCall // the result of calling Output::capture
            ),
        ];

        return $node;
    }
}
