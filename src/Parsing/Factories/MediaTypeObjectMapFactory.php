<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\MediaTypeObject;
use Worq\OpenApiParser\Model\MediaTypeObjectMap;
use Worq\OpenApiParser\Parsing\ParseContext;

final class MediaTypeObjectMapFactory implements MediaTypeObjectMapFactoryInterface
{
    public function create(array $data, ParseContext $context): MediaTypeObjectMap
    {
        return new MediaTypeObjectMap(
            array_map(
                fn ($mediaType) => $context->factory->create(MediaTypeObject::class, $mediaType, $context),
                $data,
            ),
        );
    }
}