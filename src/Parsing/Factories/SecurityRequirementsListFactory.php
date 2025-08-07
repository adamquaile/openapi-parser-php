<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\SecurityRequirementObject;
use TypeSlow\OpenApiParser\Model\SecurityRequirementsList;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

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
