<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\SecurityRequirementsList;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface SecurityRequirementsListFactoryInterface
{
    public function create(array $data, ParseContext $context): SecurityRequirementsList;
}
