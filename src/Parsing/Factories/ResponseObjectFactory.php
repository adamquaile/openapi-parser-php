<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\MediaTypeObjectMap;
use TypeSlow\OpenApiParser\Model\ResponseObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class ResponseObjectFactory implements ResponseObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): ResponseObject
    {
        return new ResponseObject(
            description: $data->description,
            content: $context->factory->create(MediaTypeObjectMap::class, $data->content ?? null, $context),
        );
    }
}
