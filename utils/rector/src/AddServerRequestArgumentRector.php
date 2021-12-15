<?php

declare(strict_types=1);

namespace Utils\Rector;

use PhpParser\Node\Param;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node;
use PhpParser\Node\Stmt\ClassMethod;
use Psr\Http\Message\ServerRequestInterface;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
use Rector\NodeTypeResolver\Node\AttributeKey;

final class AddServerRequestArgumentRector extends AbstractRector
{
    public function getNodeTypes(): array
    {
        return [ClassMethod::class];
    }

    /**
     * @param ClassMethod $node
     */
    public function refactor(Node $node): ?Node
    {
        if (!empty($node->params)) {
            return null;
        }

        if (!str_contains(strtolower($node->getAttribute(AttributeKey::CLASS_NAME)), 'controller')) {
            return null;
        }

        if (!$node->isPublic()) {
            return null;
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
        return new RuleDefinition('Add ServerRequestInterface argument to all controller actions', []);
    }
}
