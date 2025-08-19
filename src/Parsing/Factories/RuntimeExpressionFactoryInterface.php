<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\RuntimeExpression;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface RuntimeExpressionFactoryInterface
{
    public function create(string $expression, ParseContext $context): RuntimeExpression;
}
