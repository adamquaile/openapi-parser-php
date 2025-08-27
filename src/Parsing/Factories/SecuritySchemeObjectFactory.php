<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\OAuthFlowsObject;
use AdamQ\OpenApiParser\Model\SecuritySchemeObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

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
