<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\ExampleObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface ExampleObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): ExampleObject;
}
