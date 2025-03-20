<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\SecurityRequirementObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class SecurityRequirementObjectFactory implements SecurityRequirementObjectFactoryInterface
{
    use MapFactoryTrait;

    public function create(object $data, ParseContext $context): SecurityRequirementObject
    {
        return new SecurityRequirementObject(items: $data);
    }
}
