<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\OAuthFlowObject;
use TypeSlow\OpenApiParser\Model\OAuthFlowsObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class OAuthFlowsObjectFactory implements OAuthFlowsObjectFactoryInterface
{
    use SpecificationExtensionFactoryTrait;

    public function create(object $data, ParseContext $context): OAuthFlowsObject
    {
        return new OAuthFlowsObject(
            implicit: $context->factory->create(OAuthFlowObject::class, $data->implicit ?? null, $context),
            password: $context->factory->create(OAuthFlowObject::class, $data->password ?? null, $context),
            clientCredentials: $context->factory->create(OAuthFlowObject::class, $data->clientCredentials ?? null, $context),
            authorizationCode: $context->factory->create(OAuthFlowObject::class, $data->authorizationCode ?? null, $context),
            x: $this->parsedExtensionObject($data),
        );
    }
}
