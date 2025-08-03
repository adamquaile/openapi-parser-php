<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\SchemaObject;
use TypeSlow\OpenApiParser\Model\SchemaObjectMap;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

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
