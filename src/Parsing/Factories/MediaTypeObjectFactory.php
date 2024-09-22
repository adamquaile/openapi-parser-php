<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\MediaTypeObject;
use TypeSlow\OpenApiParser\Model\SchemaObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class MediaTypeObjectFactory implements MediaTypeObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): MediaTypeObject
    {
        return new MediaTypeObject(
            schema: $context->factory->create(SchemaObject::class, $data->schema ?? null, $context),
            example: $data->example ?? null,
        );
    }
}