<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Model;

final class MediaTypeObject implements HasSpecificationExtensions
{
    public function __construct(
        public ?SchemaObject $schema = null,
        public mixed $example = null,
        public ?ExamplesMap $examples = null,
        public ?EncodingObjectMap $encoding = null,
        public object $x = new \stdClass(),
    ) {
    }
}
