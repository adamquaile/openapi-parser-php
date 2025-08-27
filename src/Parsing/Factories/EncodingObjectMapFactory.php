<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\EncodingObject;
use AdamQ\OpenApiParser\Model\EncodingObjectMap;
use AdamQ\OpenApiParser\Parsing\ParseContext;

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
