<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\ExampleObjectMap;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface ExampleObjectMapFactoryInterface
{
    public function create(object $data, ParseContext $context): ExampleObjectMap;
}
