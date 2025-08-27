<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\SecurityRequirementObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface SecurityRequirementObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): SecurityRequirementObject;
}
