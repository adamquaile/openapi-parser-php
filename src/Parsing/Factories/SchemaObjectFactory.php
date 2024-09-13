<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\SchemaObject;
use Worq\OpenApiParser\Parsing\ParseContext;

final class SchemaObjectFactory implements SchemaObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): SchemaObject
    {
        return new SchemaObject();
    }
}
