<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\SchemaObject;
use AdamQ\OpenApiParser\Model\SchemaObjectMap;
use AdamQ\OpenApiParser\Parsing\ParseContext;

class SchemaObjectMapFactory implements SchemaObjectMapFactoryInterface
{
    use MapFactoryTrait;

    public function create(object $data, ParseContext $context): SchemaObjectMap
    {
        self::modifyEveryObjectProperty(
            $data,
            fn ($property) => $context->factory->create(SchemaObject::class, $property, $context),
        );
        return new SchemaObjectMap(items: $data);
    }
}
