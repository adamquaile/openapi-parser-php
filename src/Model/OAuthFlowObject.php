<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Model;

final class OAuthFlowObject implements HasSpecificationExtensions
{
    public function __construct(
        public string $authorizationUrl,
        public string $tokenUrl,
        public OAuthFlowScopesMap $scopes,
        public ?string $refreshUrl = null,
        public object $x = new \stdClass(),
    ) {
    }
}
