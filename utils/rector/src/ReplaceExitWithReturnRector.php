<?php
declare(strict_types=1);

namespace Utils\Rector;

use PhpParser\Node;
use PhpParser\Node\Expr\Exit_;
use PhpParser\Node\Stmt;
use PhpParser\Node\Stmt\Expression;
use PhpParser\Node\Stmt\Return_;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class ReplaceExitWithReturnRector extends AbstractRector
{
    public function getNodeTypes(): array
    {
        return [Expression::class];
    }

    /**
     * @param Expression $node
     */
    public function refactor(Node $node): ?Return_
    {
        if (!$node->expr instanceof Exit_) {
            return null;
        }

        return new Return_();
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Change exit into return', []);
    }
}
