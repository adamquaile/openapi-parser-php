<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\SecurityRequirementObject;
use AdamQ\OpenApiParser\Model\SecurityRequirementsList;
use AdamQ\OpenApiParser\Parsing\ParseContext;

final class SecurityRequirementsListFactory implements SecurityRequirementsListFactoryInterface
{
    use ListFactoryTrait;

    public function create(array $data, ParseContext $context): SecurityRequirementsList
    {
        self::modifyEveryObjectProperty(
            $data,
            fn (object $securityRequirement) => $context->factory->create(SecurityRequirementObject::class, $securityRequirement, $context)
        );
        return new SecurityRequirementsList(items: $data);
    }
}
