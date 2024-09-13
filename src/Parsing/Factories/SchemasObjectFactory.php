<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\SchemaObject;
use Worq\OpenApiParser\Model\SchemasObject;
use Worq\OpenApiParser\Parsing\ParseContext;

class SchemasObjectFactory implements SchemasObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): SchemasObject
    {
        array_walk(
            $data,
            fn ($schema) => $context->factory->create(SchemaObject::class, $schema, $context),
        );
        return new SchemasObject(items: $data);
    }
}
