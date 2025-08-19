<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Model;

#[\AllowDynamicProperties]
final class SchemaObject implements HasSpecificationExtensions
{
    public function __construct(
        public ?DiscriminatorObject $discriminator = null,
        public ?XmlObject $xml = null,
        public ?ExternalDocumentationObject $externalDocs = null,
        public mixed $example = null,
        public ?object $dynamic = null,
        public object $x = new \stdClass(),
    ) {
    }

    public function __get(string $key): mixed
    {
        return $this->dynamic->{$key};
    }

}
