<?php

declare(strict_types=1);

namespace Utils\Rector;

use PhpParser\Node;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Param;
use PhpParser\Node\Stmt\ClassMethod;
use Psr\Http\Message\ServerRequestInterface;
use Rector\Core\Rector\AbstractRector;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class AddServerRequestArgumentRector extends AbstractRector
{
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

        foreach ($node->params as $param) {
            if ($this->isName($param->var, 'request')) {
                return null;
            }
        }
        $node->params[] = new Param(
            new Variable('request'),
            null,
            new FullyQualified(ServerRequestInterface::class)
        );

        return $node;
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Add ServerRequestInterface argument to controller actions', []);
    }
}
