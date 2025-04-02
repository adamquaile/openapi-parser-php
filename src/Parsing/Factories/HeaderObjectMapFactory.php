<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\HeaderObject;
use TypeSlow\OpenApiParser\Model\HeaderObjectMap;
use TypeSlow\OpenApiParser\Model\ReferenceObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

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
