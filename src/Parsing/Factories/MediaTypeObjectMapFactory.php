<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\MediaTypeObject;
use Worq\OpenApiParser\Model\MediaTypeObjectMap;
use Worq\OpenApiParser\Parsing\ParseContext;

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