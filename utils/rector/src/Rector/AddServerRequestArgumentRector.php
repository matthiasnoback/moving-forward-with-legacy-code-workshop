<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use PhpParser\Node;
use PhpParser\Node\Stmt\ClassMethod;
use PHPStan\Analyser\Scope;
use PHPStan\Type\ObjectType;
use Psr\Http\Message\ServerRequestInterface;
use Rector\Rector\AbstractScopeAwareRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Utils\Rector\Tests\Rector\AddServerRequestArgumentRector\AddServerRequestArgumentRectorTest
 */
final class AddServerRequestArgumentRector extends AbstractScopeAwareRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('// @todo fill the description', [
            new CodeSample(
                <<<'CODE_SAMPLE'
// @todo fill code before
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
// @todo fill code after
CODE_SAMPLE
            ),
        ]);
    }

    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [ClassMethod::class];
    }

    /**
     * @param ClassMethod $node
     */
    public function refactorWithScope(Node $node, Scope $scope): ?Node
    {
        if (!$scope->isInClass() || !str_ends_with($scope->getClassReflection()->getName(), 'Controller')) {
            return null;
        }

        foreach ($node->params as $param) {
            if ($this->isName($param, 'request')) {
                return null;
            }
            if ($this->isObjectType($param, new ObjectType(ServerRequestInterface::class))) {
                return null;
            }
        }

        $node->params[] = new Node\Param(new Node\Expr\Variable('request'), null,
            new Node\Name\FullyQualified(ServerRequestInterface::class));

        return $node;
    }
}
