<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

final readonly class RuntimeExpression implements \Stringable
{
    public function __construct(
        private string $expression
    ) {
    }
    public function __toString(): string
    {
        return $this->expression;
    }
}
