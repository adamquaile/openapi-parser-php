<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\SecuritySchemeObject;
use AdamQ\OpenApiParser\Model\SecuritySchemeObjectMap;
use AdamQ\OpenApiParser\Model\ReferenceObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

final class SecuritySchemeObjectMapFactory implements SecuritySchemeObjectMapFactoryInterface
{
    use MapFactoryTrait;

    public function create(object $data, ParseContext $context): SecuritySchemeObjectMap
    {
        self::modifyEveryObjectProperty(
            $data,
            fn (object $securityScheme) => isset($securityScheme->{'$ref'})
                ? $context->factory->create(ReferenceObject::class, $securityScheme, $context)
                : $context->factory->create(SecuritySchemeObject::class, $securityScheme, $context),
        );

        return new SecuritySchemeObjectMap(items: $data);
    }
}
