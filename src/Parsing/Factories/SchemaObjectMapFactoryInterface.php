<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\SchemaObjectMap;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface SchemaObjectMapFactoryInterface
{
    public function create(object $data, ParseContext $context): SchemaObjectMap;
}
