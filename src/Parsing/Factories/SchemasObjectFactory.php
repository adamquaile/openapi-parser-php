<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\SchemaObject;
use TypeSlow\OpenApiParser\Model\SchemasObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

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
