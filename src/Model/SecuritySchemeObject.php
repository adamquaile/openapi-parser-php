<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Model;

final class SecuritySchemeObject implements HasSpecificationExtensions
{
    public function __construct(
        public string $type,
        public ?string $description = null,
        public ?string $name = null,
        public ?string $in = null,
        public ?string $scheme = null,
        public ?string $bearerFormat = null,
        public ?OAuthFlowsObject $flows = null,
        public ?string $openIdConnectUrl = null,
        public object $x = new \stdClass(),
    ) {
    }
}
