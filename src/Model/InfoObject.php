<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

final readonly class InfoObject implements HasSpecificationExtensions
{
    public function __construct(
        public string $title,
        public string $version,
        public ?string $summary = null,
        public ?string $description = null,
        public ?string $termsOfService = null,
        public ?ContactObject $contact = null,
        public ?LicenseObject $license = null,
        public object $x = new \stdClass(),
    ) {

    }
}
