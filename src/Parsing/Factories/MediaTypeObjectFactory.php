<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\EncodingObject;
use TypeSlow\OpenApiParser\Model\EncodingObjectMap;
use TypeSlow\OpenApiParser\Model\ExamplesMap;
use TypeSlow\OpenApiParser\Model\MediaTypeObject;
use TypeSlow\OpenApiParser\Model\SchemaObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class MediaTypeObjectFactory implements MediaTypeObjectFactoryInterface
{
    use SpecificationExtensionFactoryTrait;

    public function create(object $data, ParseContext $context): MediaTypeObject
    {
        return new MediaTypeObject(
            schema: $context->factory->create(SchemaObject::class, $data->schema ?? null, $context),
            example: $data->example ?? null,
            examples: $context->factory->create(ExamplesMap::class, $data->examples ?? null, $context),
            encoding: $context->factory->create(EncodingObjectMap::class, $data->encoding ?? null, $context),
            x: $this->parsedExtensionObject($data),
        );
    }
}