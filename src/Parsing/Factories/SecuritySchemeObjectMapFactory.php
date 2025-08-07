<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\SecuritySchemeObject;
use TypeSlow\OpenApiParser\Model\SecuritySchemeObjectMap;
use TypeSlow\OpenApiParser\Model\ReferenceObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

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
