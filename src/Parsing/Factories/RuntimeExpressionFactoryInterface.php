<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\RuntimeExpression;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface RuntimeExpressionFactoryInterface
{
    public function create(string $expression, ParseContext $context): RuntimeExpression;
}
