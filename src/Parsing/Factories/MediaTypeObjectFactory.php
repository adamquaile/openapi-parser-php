<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\EncodingObject;
use AdamQ\OpenApiParser\Model\EncodingObjectMap;
use AdamQ\OpenApiParser\Model\ExamplesMap;
use AdamQ\OpenApiParser\Model\MediaTypeObject;
use AdamQ\OpenApiParser\Model\SchemaObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

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