<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\RequestBodyObject;
use TypeSlow\OpenApiParser\Model\RequestBodyObjectMap;
use TypeSlow\OpenApiParser\Model\ReferenceObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

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
