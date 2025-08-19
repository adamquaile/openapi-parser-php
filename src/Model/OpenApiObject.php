<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Model;

final readonly class OpenApiObject implements HasSpecificationExtensions
{
    public function __construct(
        public string $openapi,
        public InfoObject $info,
        public ?string $jsonSchemaDialect = null,
        public ?ServersList $servers = null,
        public ?PathsObject $paths = null,
        public ?ComponentsObject $components = null,
        public ?SecurityRequirementsList $security = null,
        public ?TagsList $tags = null,
        public ?ExternalDocumentationObject $externalDocs = null,
        public object $x = new \stdClass(),
    ) {

    }
}
