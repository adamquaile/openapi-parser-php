<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\ResponseObject;
use Worq\OpenApiParser\Model\ResponsesObject;
use Worq\OpenApiParser\Parsing\ParseContext;

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
