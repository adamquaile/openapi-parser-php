<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\OAuthFlowObject;
use TypeSlow\OpenApiParser\Model\OAuthFlowScopesMap;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class OAuthFlowObjectFactory implements OAuthFlowObjectFactoryInterface
{
    use SpecificationExtensionFactoryTrait;

    public function create(object $data, ParseContext $context): OAuthFlowObject
    {
        return new OAuthFlowObject(
            authorizationUrl: $data->authorizationUrl,
            tokenUrl: $data->tokenUrl,
            scopes: new OAuthFlowScopesMap(items: $data->scopes),
            refreshUrl: $data->refreshUrl ?? null,
            x: $this->parsedExtensionObject($data),
        );
    }
}
