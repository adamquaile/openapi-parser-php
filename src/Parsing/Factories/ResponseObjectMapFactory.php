<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\ReferenceObject;
use AdamQ\OpenApiParser\Model\ResponseObject;
use AdamQ\OpenApiParser\Model\ResponseObjectMap;
use AdamQ\OpenApiParser\Parsing\ParseContext;

final class ResponseObjectMapFactory implements ResponseObjectMapFactoryInterface
{
    use MapFactoryTrait;

    public function create(object $data, ParseContext $context): ResponseObjectMap
    {
        self::modifyEveryObjectProperty(
            $data,
            fn (object $response) => isset($response->{'$ref'})
                ? $context->factory->create(ReferenceObject::class, $response, $context)
                : $context->factory->create(ResponseObject::class, $response, $context),
        );

        return new ResponseObjectMap(items: $data);
    }
}
