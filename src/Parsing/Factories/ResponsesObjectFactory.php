<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\ResponseObject;
use TypeSlow\OpenApiParser\Model\ResponsesObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class ResponsesObjectFactory implements ResponsesObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): ResponsesObject
    {
        array_walk(
            $data,
            fn (object $response) => $context->factory->create(ResponseObject::class, $response, $context),
        );
        return new ResponsesObject(items: $data);
    }
}
