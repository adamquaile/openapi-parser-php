<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\HeaderObjectMap;
use AdamQ\OpenApiParser\Model\LinkObjectMap;
use AdamQ\OpenApiParser\Model\MediaTypeObjectMap;
use AdamQ\OpenApiParser\Model\ResponseObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

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
