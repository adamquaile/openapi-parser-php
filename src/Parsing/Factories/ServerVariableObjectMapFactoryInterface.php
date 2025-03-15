<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\ServerVariableObjectMap;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface ServerVariableObjectMapFactoryInterface
{
    public function create(object $data, ParseContext $context): ServerVariableObjectMap;
}
