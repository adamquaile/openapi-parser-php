<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\ResponseObject;
use Worq\OpenApiParser\Model\ResponsesObject;
use Worq\OpenApiParser\Parsing\ParseContext;

final class ResponsesObjectFactory implements ResponsesObjectFactoryInterface
{
    public function create(array $data, ParseContext $context): ResponsesObject
    {
        return new ResponsesObject(
            items: array_map(
                fn (array $response) => $context->factory->create(ResponseObject::class, $response, $context),
                $data
            )
        );
    }
}
