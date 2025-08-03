<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\PathItemObject;
use TypeSlow\OpenApiParser\Model\PathItemObjectMap;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

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
