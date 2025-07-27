<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\ParametersList;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface ParametersListFactoryInterface
{
    public function create(array $data, ParseContext $context): ParametersList;
}
