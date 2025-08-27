<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\LinkObject;
use AdamQ\OpenApiParser\Model\LinkObjectMap;
use AdamQ\OpenApiParser\Model\ReferenceObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

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
