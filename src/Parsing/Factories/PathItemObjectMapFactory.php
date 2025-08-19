<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\PathItemObject;
use AdamQ\OpenApiParser\Model\PathItemObjectMap;
use AdamQ\OpenApiParser\Parsing\ParseContext;

class PathItemObjectMapFactory implements PathItemObjectMapFactoryInterface
{
    use MapFactoryTrait;

    public function create(object $data, ParseContext $context): PathItemObjectMap
    {
        self::modifyEveryObjectProperty(
            $data,
            fn ($property) => $context->factory->create(PathItemObject::class, $property, $context),
        );
        return new PathItemObjectMap(items: $data);
    }
}
