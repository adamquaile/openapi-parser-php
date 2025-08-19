<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\RequestBodyObject;
use AdamQ\OpenApiParser\Model\RequestBodyObjectMap;
use AdamQ\OpenApiParser\Model\ReferenceObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

final class RequestBodyObjectMapFactory implements RequestBodyObjectMapFactoryInterface
{
    use MapFactoryTrait;

    public function create(object $data, ParseContext $context): RequestBodyObjectMap
    {
        self::modifyEveryObjectProperty(
            $data,
            fn (object $requestBody) => isset($requestBody->{'$ref'})
                ? $context->factory->create(ReferenceObject::class, $requestBody, $context)
                : $context->factory->create(RequestBodyObject::class, $requestBody, $context),
        );

        return new RequestBodyObjectMap(items: $data);
    }
}
