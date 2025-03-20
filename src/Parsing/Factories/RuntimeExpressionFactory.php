<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\RuntimeExpression;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class RuntimeExpressionFactory implements RuntimeExpressionFactoryInterface
{
    public function create(string $expression, ParseContext $context): RuntimeExpression
    {
        return new RuntimeExpression($expression);
    }
}
