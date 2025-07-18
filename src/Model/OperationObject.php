<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

final class OperationObject implements HasSpecificationExtensions
{
    public function __construct(
        /**
         * @var ?array<string>
         */
        public ?array $tags = null,
        public ?string $summary = null,
        public ?string $description = null,
        public ?ExternalDocumentationObject $externalDocs = null,
        public ?string $operationId = null,
        public ?OperationObjectParametersList $parameters = null,
        public RequestBodyObject|ReferenceObject|null $requestBody = null,
        public ?ResponsesObject $responses = null,
        public ?OperationObjectCallbacksMap $callbacks = null,
        public bool $deprecated = false,
        public ?SecurityRequirementObject $security = null,
        public ?ServersList $servers = null,
        public object $x = new \stdClass(),
    ) {
    }
}
