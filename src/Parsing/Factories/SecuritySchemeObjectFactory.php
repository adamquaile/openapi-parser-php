<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\OAuthFlowsObject;
use TypeSlow\OpenApiParser\Model\SecuritySchemeObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class SecuritySchemeObjectFactory implements SecuritySchemeObjectFactoryInterface
{
    use SpecificationExtensionFactoryTrait;

    public function create(object $data, ParseContext $context): SecuritySchemeObject
    {
        return new SecuritySchemeObject(
            type: $data->type,
            name: $data->name ?? null,
            in: $data->in ?? null,
            scheme: $data->scheme ?? null,
            bearerFormat: $data->bearerFormat ?? null,
            flows: $context->factory->create(OAuthFlowsObject::class, $data->flows ?? null, $context),
            openIdConnectUrl: $data->openIdConnectUrl ?? null,
            x: $this->parsedExtensionObject($data),
        );
    }
}
