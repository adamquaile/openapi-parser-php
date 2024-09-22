<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\MediaTypeObject;
use TypeSlow\OpenApiParser\Model\MediaTypeObjectMap;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

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