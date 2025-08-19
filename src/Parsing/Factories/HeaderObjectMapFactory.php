<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\HeaderObject;
use AdamQ\OpenApiParser\Model\HeaderObjectMap;
use AdamQ\OpenApiParser\Model\ReferenceObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

final class HeaderObjectMapFactory implements HeaderObjectMapFactoryInterface
{
    use MapFactoryTrait;

    public function create(object $data, ParseContext $context): HeaderObjectMap
    {
        self::modifyEveryObjectProperty(
            $data,
            fn (object $header) => isset($header->{'$ref'})
                ? $context->factory->create(ReferenceObject::class, $header, $context)
                : $context->factory->create(HeaderObject::class, $header, $context)
        );
        return new HeaderObjectMap(items: $data);
    }
}
