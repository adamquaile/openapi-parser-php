<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\ReferenceObject;
use TypeSlow\OpenApiParser\Model\ResponseObject;
use TypeSlow\OpenApiParser\Model\ResponseObjectMap;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

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
