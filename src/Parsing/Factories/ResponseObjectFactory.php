<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\HeaderObjectMap;
use TypeSlow\OpenApiParser\Model\LinkObjectMap;
use TypeSlow\OpenApiParser\Model\MediaTypeObjectMap;
use TypeSlow\OpenApiParser\Model\ResponseObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class ResponseObjectFactory implements ResponseObjectFactoryInterface
{
    use SpecificationExtensionFactoryTrait;

    public function create(object $data, ParseContext $context): ResponseObject
    {
        return new ResponseObject(
            description: $data->description,
            headers: $context->factory->create(HeaderObjectMap::class, $data->headers ?? null, $context),
            content: $context->factory->create(MediaTypeObjectMap::class, $data->content ?? null, $context),
            links: $context->factory->create(LinkObjectMap::class, $data->links ?? null, $context),
            x: $this->parsedExtensionObject($data),
        );
    }
}
