<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\OAuthFlowObject;
use AdamQ\OpenApiParser\Model\OAuthFlowsObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

final class OAuthFlowsObjectFactory implements OAuthFlowsObjectFactoryInterface
{
    use SpecificationExtensionFactoryTrait;

    public function create(object $data, ParseContext $context): OAuthFlowsObject
    {
        return new OAuthFlowsObject(
            implicit: $context->factory->create(OAuthFlowObject::class, $data->implicit ?? null, $context->withPath($context->path->append('implicit'))),
            password: $context->factory->create(OAuthFlowObject::class, $data->password ?? null, $context->withPath($context->path->append('password'))),
            clientCredentials: $context->factory->create(OAuthFlowObject::class, $data->clientCredentials ?? null, $context->withPath($context->path->append('clientCredentials'))),
            authorizationCode: $context->factory->create(OAuthFlowObject::class, $data->authorizationCode ?? null, $context->withPath($context->path->append('authorizationCode'))),
            x: $this->parsedExtensionObject($data),
        );
    }
}
