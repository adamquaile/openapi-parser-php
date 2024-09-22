<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\ServerVariablesObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface ServerVariablesObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): ServerVariablesObject;
}
