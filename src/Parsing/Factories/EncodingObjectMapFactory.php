<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\EncodingObject;
use TypeSlow\OpenApiParser\Model\EncodingObjectMap;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class EncodingObjectMapFactory implements EncodingObjectMapFactoryInterface
{
    use MapFactoryTrait;

    public function create(object $data, ParseContext $context): EncodingObjectMap
    {
        self::modifyEveryObjectProperty(
            $data,
            fn (object $encoding) => $context->factory->create(EncodingObject::class, $encoding, $context),
        );

        return new EncodingObjectMap(
            items: $data
        );
    }
}
