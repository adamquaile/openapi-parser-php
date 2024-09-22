<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\LicenseObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface LicenseObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): LicenseObject;
}
