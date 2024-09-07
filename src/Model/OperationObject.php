<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Model;

final class OperationObject
{
    public function __construct(
        public ?string $summary = null,
        public ?string $description = null,
        public ?ExternalDocumentationObject $externalDocs = null,
        public ?string $operationId = null,
        public ?array $parameters = null,
        public ?RequestBodyObject $requestBody = null,
        public ?ResponsesObject $responses = null,
        public ?array $callbacks = null,
        public ?bool $deprecated = null,
        public ?array $security = null,
        public ?array $servers = null,
    ) {
    }
}