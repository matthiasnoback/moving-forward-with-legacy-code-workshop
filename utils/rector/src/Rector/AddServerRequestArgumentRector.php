<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use PhpParser\Node;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Param;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PHPStan\Type\ObjectType;
use Psr\Http\Message\ServerRequestInterface;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Utils\Rector\Tests\Rector\AddServerRequestArgumentRector\AddServerRequestArgumentRectorTest
 */
final class AddServerRequestArgumentRector extends AbstractRector
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
        return [Class_::class];
    }

    /**
     * @param Class_ $node
     */
    public function refactor(Node $node): ?Node
    {
        if (!str_ends_with($this->getName($node) ?? '', 'Controller')) {
            return null;
        }

        $isModified = false;
        foreach ($node->getMethods() as $method) {
            $method = $this->processControllerMethod($method);
            if ($method instanceof ClassMethod) {
                $isModified = true;
            }
        }

        return $isModified ? $node : null;
    }

    public function processControllerMethod(ClassMethod $method): ?ClassMethod
    {
        foreach ($method->params as $param) {
            if ($this->isObjectType($param, new ObjectType(ServerRequestInterface::class))) {
                // There is already a parameter with type ServerRequestInterface
                return null;
            }

            if ($this->isName($param, 'request')) {
                // There is already a parameter with name 'request'
                return null;
            }
        }

        $method->params[] = new Param(
            var: new Variable(name: 'request'),
            type: new FullyQualified(ServerRequestInterface::class)
        );

        return $method;
    }
}
