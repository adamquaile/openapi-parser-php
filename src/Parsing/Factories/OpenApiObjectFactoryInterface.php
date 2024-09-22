<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\OpenApiObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface OpenApiObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): OpenApiObject;
}
