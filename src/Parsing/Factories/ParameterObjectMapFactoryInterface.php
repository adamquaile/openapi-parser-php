<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\ParameterObjectMap;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface ParameterObjectMapFactoryInterface
{
    public function create(object $data, ParseContext $context): ParameterObjectMap;
}
