<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\SecurityRequirementsList;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface SecurityRequirementsListFactoryInterface
{
    public function create(array $data, ParseContext $context): SecurityRequirementsList;
}
