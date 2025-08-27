<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\SchemaObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface SchemaObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): SchemaObject;
}
