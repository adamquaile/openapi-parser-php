<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\LinkObject;
use TypeSlow\OpenApiParser\Model\LinkObjectMap;
use TypeSlow\OpenApiParser\Model\ReferenceObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class LinkObjectMapFactory implements LinkObjectMapFactoryInterface
{
    use MapFactoryTrait;

    public function create(object $data, ParseContext $context): LinkObjectMap
    {
        self::modifyEveryObjectProperty(
            $data,
            fn (object $header) => isset($header->{'$ref'})
                ? $context->factory->create(ReferenceObject::class, $header, $context)
                : $context->factory->create(LinkObject::class, $header, $context)
        );
        return new LinkObjectMap(items: $data);
    }
}
