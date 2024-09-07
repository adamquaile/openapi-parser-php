<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\MediaTypeObject;
use Worq\OpenApiParser\Model\SchemaObject;
use Worq\OpenApiParser\Parsing\ParseContext;

final class MediaTypeObjectFactory implements MediaTypeObjectFactoryInterface
{
    public function create(array $data, ParseContext $context): MediaTypeObject
    {
        return new MediaTypeObject(
            schema: $context->factory->create(SchemaObject::class, $data['schema'], $context),
            example: $data['example'] ?? null,
        );
    }
}