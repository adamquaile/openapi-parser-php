<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

final class OAuthFlowsObject implements HasSpecificationExtensions
{
    public function __construct(
        public ?OAuthFlowObject $implicit = null,
        public ?OAuthFlowObject $password = null,
        public ?OAuthFlowObject $clientCredentials = null,
        public ?OAuthFlowObject $authorizationCode = null,
        public object $x = new \stdClass(),
    ) {
    }
}
