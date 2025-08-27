<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\OAuthFlowObject;
use AdamQ\OpenApiParser\Model\OAuthFlowScopesMap;
use AdamQ\OpenApiParser\Parsing\ParseContext;

final class OAuthFlowObjectFactory implements OAuthFlowObjectFactoryInterface
{
    use SpecificationExtensionFactoryTrait;

    public function create(object $data, ParseContext $context): OAuthFlowObject
    {
        $scopes = new OAuthFlowScopesMap(items: $data->scopes);
        $refreshUrl = $data->refreshUrl ?? null;
        $x = $this->parsedExtensionObject($data);

        return match (true) {
            str_ends_with((string) $context->path, '.implicit') => OAuthFlowObject::implicit(
                authorizationUrl: $data->authorizationUrl,
                scopes: $scopes,
                refreshUrl: $refreshUrl,
                x: $x,
            ),
            str_ends_with((string) $context->path, '.password') => OAuthFlowObject::password(
                tokenUrl: $data->tokenUrl,
                scopes: $scopes,
                refreshUrl: $refreshUrl,
                x: $x,
            ),
            str_ends_with((string) $context->path, '.clientCredentials') => OAuthFlowObject::clientCredentials(
                tokenUrl: $data->tokenUrl,
                scopes: $scopes,
                refreshUrl: $refreshUrl,
                x: $x,
            ),
            str_ends_with((string) $context->path, '.authorizationCode') => OAuthFlowObject::authorizationCode(
                authorizationUrl: $data->authorizationUrl,
                tokenUrl: $data->tokenUrl,
                scopes: $scopes,
                refreshUrl: $refreshUrl,
                x: $x,
            ),
            default => throw new \InvalidArgumentException('Unable to determine OAuth flow type'),
        };
    }
}
