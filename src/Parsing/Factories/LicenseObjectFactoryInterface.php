<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\LicenseObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface LicenseObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): LicenseObject;
}
