<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\SchemaObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface SchemaObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): SchemaObject;
}
