<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Model;

final class OAuthFlowObject implements HasSpecificationExtensions
{
    /**
     * @internal
     */
    public function __construct(
        public OAuthFlowScopesMap $scopes,
        public ?string $authorizationUrl = null,
        public ?string $tokenUrl = null,
        public ?string $refreshUrl = null,
        public object $x = new \stdClass(),
    ) {
    }

    public static function implicit(
        string $authorizationUrl,
        OAuthFlowScopesMap $scopes,
        ?string $refreshUrl = null,
        object $x = new \stdClass(),
    ): self {
        return new self(
            scopes: $scopes,
            authorizationUrl: $authorizationUrl,
            tokenUrl: null,
            refreshUrl: $refreshUrl,
            x: $x,
        );
    }

    public static function password(
        string $tokenUrl,
        OAuthFlowScopesMap $scopes,
        ?string $refreshUrl = null,
        object $x = new \stdClass(),
    ): self {
        return new self(
            scopes: $scopes,
            authorizationUrl: null,
            tokenUrl: $tokenUrl,
            refreshUrl: $refreshUrl,
            x: $x,
        );
    }

    public static function clientCredentials(
        string $tokenUrl,
        OAuthFlowScopesMap $scopes,
        ?string $refreshUrl = null,
        object $x = new \stdClass(),
    ): self {
        return new self(
            scopes: $scopes,
            authorizationUrl: null,
            tokenUrl: $tokenUrl,
            refreshUrl: $refreshUrl,
            x: $x,
        );
    }

    public static function authorizationCode(
        string $authorizationUrl,
        string $tokenUrl,
        OAuthFlowScopesMap $scopes,
        ?string $refreshUrl = null,
        object $x = new \stdClass(),
    ): self {
        return new self(
            scopes: $scopes,
            authorizationUrl: $authorizationUrl,
            tokenUrl: $tokenUrl,
            refreshUrl: $refreshUrl,
            x: $x,
        );
    }
}
