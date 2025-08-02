<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\ExamplesMap;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface ExamplesMapFactoryInterface
{
    public function create(object $data, ParseContext $context): ExamplesMap;
}
