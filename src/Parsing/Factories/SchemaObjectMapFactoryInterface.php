<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\SchemaObjectMap;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface SchemaObjectMapFactoryInterface
{
    public function create(object $data, ParseContext $context): SchemaObjectMap;
}
