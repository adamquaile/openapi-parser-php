<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\SchemaObject;
use Worq\OpenApiParser\Model\SchemasObject;
use Worq\OpenApiParser\Parsing\ParseContext;

class SchemasObjectFactory implements SchemasObjectFactoryInterface
{
    public function create(array $data, ParseContext $context): SchemasObject
    {
        return new SchemasObject(
            array_map(
                fn ($schema) => $context->factory->create(SchemaObject::class, $schema, $context),
                $data
            )
        );
    }
}
