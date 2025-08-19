<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\MediaTypeObject;
use AdamQ\OpenApiParser\Model\MediaTypeObjectMap;
use AdamQ\OpenApiParser\Parsing\ParseContext;

final class MediaTypeObjectMapFactory implements MediaTypeObjectMapFactoryInterface
{
    public function create(object $data, ParseContext $context): MediaTypeObjectMap
    {
        array_walk(
            $data,
            fn ($mediaType) => $context->factory->create(MediaTypeObject::class, $mediaType, $context),
        );

        return new MediaTypeObjectMap(items: $data);
    }
}